<?php

declare(strict_types=1);

/**
 * Author: panosru
 * Date: 20/02/2018
 * Time: 01:55
 */

namespace Omega\FaultManager;

use Omega\FaultManager\Interfaces\FaultManager as IFaultManager;
use Omega\FaultManager\Traits\FaultEventStream as TFaultEventStream;
use Omega\FaultManager\Traits\FaultGenerator as TFaultGenerator;
use Omega\FaultManager\Traits\FaultMutator as TFaultMutator;
use Omega\FaultManager\Traits\FaultReflector as TFaultReflector;

/**
 * Class Fault
 * @package Omega\FaultManager
 */
class Fault implements IFaultManager
{
    use TFaultGenerator;
    use TFaultEventStream;
    use TFaultMutator;
    use TFaultReflector;

    /**
     * Fault constructor.
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * {@inheritdoc}
     */
    public static function exception(
        string $exceptionClass,
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
        array $arguments = []
    ): \Throwable {
        // Check if $class is empty
        if (empty($exceptionClass)) {
            throw new Exceptions\ExceptionNameIsEmpty();
        }

        $params = [&$message, $code, $previous];

        // Check if exceptionClass with that name already exists
        // we mute class_exists because we leave second parameter as a default (which is true by default)
        // in order to autoload the class if exists, but if we do not mute it and the class does not exists
        // then aside from returned boolean false, we get some php warnings like this:
        // Warning: include(/path/to/MyCustomException.php): failed to open stream: No such file or directory
        // That is normal behaviour since we ask to autoload a class which does not exists yet.
        // On the second run when we request the class that has been generated, it will be autoload here
        if (!@\class_exists($exceptionClass)) {
            // Check if is namespace
            if (false !== \strpos($exceptionClass, '\\')) {
                throw new Exceptions\NamespaceError();
            }

            // Check if the class already exists
            if (!self::fileSystem()->has(self::makeFileName($exceptionClass))) {
                // Default class to extend from
                $extendFromClass = \Exception::class;

                if (self::isEventStreamEnabled()) {
                    // Since EventStream is enabled then we extend from BaseError Abstract
                    $extendFromClass = Abstracts\FaultManagerException::class; // @codeCoverageIgnore
                }

                // Persist generated exceptionClass into file under compiled directory
                self::persistFile(
                    $exceptionClass,
                    self::generateFileCode($exceptionClass, $extendFromClass)
                );
            }

            if (self::autoloadEnabled()) {
                // Load custom generated class
                self::loadCustomException(self::fileSystem()->compiledExceptions([$exceptionClass])->current());
            } else {
                $reflection = self::reflectFromFile(self::compilePath() . self::makeFileName($exceptionClass));
            }
        }

        $reflection = $reflection ?? self::reflectFromClassName($exceptionClass);


        // Get exceptionClass interfaces
        // The reason we do not get an instance here and use instanceof is because if we get an instance here
        // then the event will be triggered and also:
        // PHP gets the line on which the object was instantiated [http://php.net/manual/en/throwable.getline.php]
        $interfaces = $reflection->getInterfaceNames();

        // Make sure that the requested class is \Throwable
        if (!\in_array(\Throwable::class, $interfaces, true)) {
            throw new Exceptions\BaseError(
                'The class "%s" does not implements Throwable interface.',
                null,
                null,
                [$exceptionClass]
            );
        }

        // Check if exceptionClass implements BaseError interface or if is a Hoa\Exception
        if (\in_array(Interfaces\FaultManagerException::class, $interfaces, true) ||
            \in_array('Hoa\Exception', $interfaces, true)
        ) {
            // Then we pass $arguments as fourth parameter for constructor
            $params[] = $arguments;
        } elseif (0 < \count($arguments)) {
            // if there are arguments set then format the exception message
            $message = @vsprintf($message, $arguments);
        }

        // Get exception instance
        //TODO: Use native Reflection untill this is solved: https://github.com/Roave/BetterReflection/pull/375
        /** @var \Throwable $exception */
        $exception = (new \ReflectionClass($exceptionClass))->newInstanceArgs($params);

        if (!($exception instanceof \Hoa\Event\Source) &&
            self::isEventStreamEnabled()
        ) {
            // Mutate the object
            self::mutate($exception);
            // Route exceptions that are either PHP build-in or are already predefined and do not
            // have support for FaultManager EventStream
            //TODO: maybe make RouteExceptions plugin to follow Singleton Pattern?
            self::registerEvent(new Plugins\RouteExceptions(), $exception);
        }

        return $exception;
    }

    /**
     * {@inheritdoc}
     */
    public static function throw(
        string $exceptionClass,
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
        array $arguments = []
    ): void {
        throw self::exception($exceptionClass, $message, $code, $previous, $arguments);
    }
}
