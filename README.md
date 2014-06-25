LitGroupEventLoopBundle
=======================

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