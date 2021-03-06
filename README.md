# Fault Manager

A convinient way for exception handling and generating on the fly non-existing exceptions.

[![version][version-badge]][package]
[![Build Status][build-badge]][build]
[![Code Coverage][coverage-badge]][coverage]
[![StyleCI][styleci-badge]][styleci]
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/panosru/fault-manager/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/panosru/fault-manager/?branch=master)
[![Documentation Status](https://readthedocs.org/projects/fault-manager/badge/?version=latest)](http://fault-manager.readthedocs.io/en/latest/?badge=latest)
[![MIT License][license-badge]][license]

[![All Contributors](https://img.shields.io/badge/all_contributors-1-orange.svg?style=flat-square)](CONTRIBUTORS.md)
[![PRs Welcome][prs-badge]][prs] [![Code of Conduct][coc-badge]][coc]
[![downloads][downloads-badge]][downloads]
[![Watch on GitHub][github-watch-badge]][github-watch]
[![Star on GitHub][github-star-badge]][github-star]
[![Tweet][twitter-badge]][twitter]

## Installing

```bash
composer require panosru/fault-manager
```

[~ Read the docs](http://fault-manager.readthedocs.io/) to get started.

## Contributing & Code of Conduct

Please read [CONTRIBUTING](CONTRIBUTING.md) for details on our [code of conduct](CODE_OF_CONDUCT.md), and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/panosru/fault-manager/tags). 

## Authors

* **Panagiotis Kosmidis (AKA @panosru)**

See also the list of [contributors](CONTRIBUTORS.md) who participated in this project.

## Built With

* [Hoa\Exception](https://hoa-project.net/En/Literature/Hack/Exception.html) - Advanced exceptions
* [Hoa\Event](https://hoa-project.net/En/Literature/Hack/Event.html) - Used as event listener
* [zend-code](https://docs.zendframework.com/zend-code/) - Used for custom exception object generation
* [Flysystem](http://flysystem.thephpleague.com/docs/) - Used for file-handling manipulation
* [PHPUnit](https://phpunit.readthedocs.io/en/7.1/index.html) - Used for unit testing
* [Mockery](http://docs.mockery.io/en/latest/index.html) - Used for objects mocking
* [RMT - Release Management Tool](https://github.com/liip/RMT) - Used for project versioning
* [all-contributors-cli](https://www.npmjs.com/package/all-contributors-cli) - Used to add/generate contributors list

## Acknowledgment

* Oskar Schöldström (@oxyc), [script.sh](https://github.com/oxyc/bash-boilerplate/blob/master/script.sh)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

[styleci-badge]: https://styleci.io/repos/130613874/shield?branch=master
[styleci]: https://styleci.io/repos/130613874
[build-badge]: https://secure.travis-ci.org/panosru/fault-manager.svg?branch=master
[build]: https://secure.travis-ci.org/panosru/fault-manager
[coverage-badge]: https://coveralls.io/repos/github/panosru/fault-manager/badge.svg?branch=master
[coverage]: https://coveralls.io/github/panosru/fault-manager?branch=master
[version-badge]: https://img.shields.io/packagist/v/panosru/fault-manager.svg
[package]: https://packagist.org/packages/panosru/fault-manager
[downloads-badge]: https://img.shields.io/packagist/dm/panosru/fault-manager.svg
[downloads]: https://packagist.org/packages/panosru/fault-manager/stats
[license-badge]: https://img.shields.io/packagist/l/panosru/fault-manager.svg
[license]: LICENSE

[prs-badge]: https://img.shields.io/badge/PRs-welcome-brightgreen.svg
[prs]: http://makeapullrequest.com
[coc-badge]: https://img.shields.io/badge/code%20of-conduct-ff69b4.svg
[coc]: CODE_OF_CONDUCT.md
[github-watch-badge]: https://img.shields.io/github/watchers/panosru/fault-manager.svg?style=social
[github-watch]: https://github.com/panosru/fault-manager/watchers
[github-star-badge]: https://img.shields.io/github/stars/panosru/fault-manager.svg?style=social
[github-star]: https://github.com/panosru/fault-manager/stargazers
[twitter]: https://twitter.com/intent/tweet?text=Check%20out%20FaultManager!%20https://github.com/panosru/fault-manager%20%F0%9F%91%8D
[twitter-badge]: https://img.shields.io/twitter/url/https://github.com/panosru/fault-manager.svg?style=social
