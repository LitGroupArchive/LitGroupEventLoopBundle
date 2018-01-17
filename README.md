LitGroupEventLoopBundle
=======================

🚫 **(This project is no longer maintained.)**

This bundle integrates [react/event-loop][event-loop] library into the Symfony 2.

[![Latest Stable Version](https://poser.pugx.org/litgroup/event-loop-bundle/v/stable.svg)](https://packagist.org/packages/litgroup/event-loop-bundle)
[![Total Downloads](https://poser.pugx.org/litgroup/event-loop-bundle/downloads.svg)](https://packagist.org/packages/litgroup/event-loop-bundle)
[![Latest Unstable Version](https://poser.pugx.org/litgroup/event-loop-bundle/v/unstable.svg)](https://packagist.org/packages/litgroup/event-loop-bundle)
[![License](https://poser.pugx.org/litgroup/event-loop-bundle/license.svg)](https://packagist.org/packages/litgroup/event-loop-bundle)

Master branch status:
[![Build Status](https://travis-ci.org/LitGroup/LitGroupEventLoopBundle.svg?branch=master)](https://travis-ci.org/LitGroup/LitGroupEventLoopBundle)

Installation
------------

Use a _Composer_ to install _LitGroupEventLoopBundle_.

```json
"require": {
    "litgroup/event-loop-bundle": "1.0.x-dev"
}
```

Do not forget to register the bundle in the AppKernel:

```php
<?php // AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new LitGroup\Bundle\EventLoopBundle\LitGroupEventLoopBundle(),
        ];
        // ...

        return $bundles;
    }
 	
    // ...   
}
```

Configuration
-------------

*No configuration needed this time.*

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

### Periodic Services

__Periodic service__ — service, defined in the dependency injection container, marked by tag `litgroup_event_loop.periodic`. These services will be called periodically when loop is running.

Tag has two required attributes:
  * `interval` — interval between calls;
  * `method` — service method to call.
  
Interval can be set as seconds represented by double value or as string with time units (`10ms`, `1m`). Interval cannot be less then 1ms.

String representation supports four units:
  * `ms` milliseconds
  * `s` seconds
  * `m` minutes
  * `h` hours
  
Units cannot be mixed.

Example: `10s`, `15m`, `1.5h`

#### Periodic service definition's example

Service class:
```php
<?php

class PeriodicService
{
	public function tick()
	{
		echo "Tick!";
    }
}
```

DIC configuration:
``` xml
<?xml version="1.0" encoding="UTF-8" ?>
<container xmlns="http://symfony.com/schema/dic/services"
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://symfony.com/schema/dic/services
        http://symfony.com/schema/dic/services/services-1.0.xsd"
        >

    <services>        

        <service id="periodic_service" class="PeriodicService">
            <tag name="litgroup_event_loop.periodic" interval="1s" method="tick"/>
        </service>

    </services>

</container>
```

Now, when event loop will be running `PeriodicService::tick()` will be called with period in 1 second.


License
-------

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

See details in [LICENSE][license] file.


[event-loop]: https://github.com/reactphp/event-loop "React Event Loop on GitHub"
[license]: Resources/meta/LICENSE
