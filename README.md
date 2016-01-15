Process Component
=================

Process executes commands in sub-processes.

In this example, we run a simple directory listing and get the result back:

```php
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

$process = new Process('ls -lsa');
$process->setTimeout(3600);
$process->run();
if (!$process->isSuccessful()) {
    throw new ProcessFailedException($process);
}

print $process->getOutput();
```

You can think that this is easy to achieve with plain PHP but it's not especially
if you want to take care of the subtle differences between the different platforms.

You can simplify the code by using `mustRun()` instead of `run()`, which will
throw a `ProcessFailedException` automatically in case of a problem:

```php
use Symfony\Component\Process\Process;

$process = new Process('ls -lsa');
$process->setTimeout(3600);
$process->mustRun();

print $process->getOutput();
```

And if you want to be able to get some feedback in real-time, just pass an
anonymous function to the ``run()`` method and you will get the output buffer
as it becomes available instead:

```php
use Symfony\Component\Process\Process;

$process = new Process('ls -lsa');
$process->run(function ($type, $buffer) {
    if (Process::ERR === $type) {
        echo 'ERR > '.$buffer;
    } else {
        echo 'OUT > '.$buffer;
    }
});
```

That's great if you want to execute a long running command (like rsync-ing files to a
remote server) and give feedback to the user in real-time.

Resources
---------

You can run the unit tests with the following command:

    $ cd path/to/Symfony/Component/Process/
    $ composer install
    $ phpunit
