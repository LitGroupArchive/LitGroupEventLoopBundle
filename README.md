LitGroupEventLoopBundle
=======================

This bundle integrates _react/event-loop_ library into the Symfony 2.

[![Latest Stable Version](https://poser.pugx.org/litgroup/event-loop-bundle/v/stable.svg)](https://packagist.org/packages/litgroup/event-loop-bundle)
[![Total Downloads](https://poser.pugx.org/litgroup/event-loop-bundle/downloads.svg)](https://packagist.org/packages/litgroup/event-loop-bundle)
[![Latest Unstable Version](https://poser.pugx.org/litgroup/event-loop-bundle/v/unstable.svg)](https://packagist.org/packages/litgroup/event-loop-bundle)
[![License](https://poser.pugx.org/litgroup/event-loop-bundle/license.svg)](https://packagist.org/packages/litgroup/event-loop-bundle)

Master branch status:
[![Build Status](https://travis-ci.org/LitGroup/LitGroupEventLoopBundle.svg?branch=master)](https://travis-ci.org/LitGroup/LitGroupEventLoopBundle)


Basic usage
-----------

### Using of an event loop

Bundle provides basics loop as a service, named `litgroup_event_loop`.
You can use it for injection or directly in your application.

Example:

```php
/** @var \React\EventLoop\LoopInterface $loop */
$loop = $container->get('litgroup_event_loop');

$loop->run();
```
