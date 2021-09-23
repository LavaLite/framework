<?php

namespace Tests {

    use Litepie\Workflow\Commands\WorkflowDumpCommand;
    use Mockery;
    use PHPUnit\Framework\TestCase;

    class WorkflowDumpCommandTest extends TestCase
    {
        public function testWorkflowCommand()
        {
            if (file_exists('straight.png')) {
                unlink('straight.png');
            }

            $command = Mockery::mock(WorkflowDumpCommand::class)
            ->makePartial()
            ->shouldReceive('argument')
            ->with('workflow')
            ->andReturn('straight')
            ->shouldReceive('option')
            ->with('format')
            ->andReturn('png')
            ->shouldReceive('option')
            ->with('class')
            ->andReturn('Tests\Fixtures\TestObject')
            ->getMock();

            $command->handle();

            $this->assertTrue(file_exists('straight.png'));
        }
    }
}

namespace {
    use Litepie\Workflow\WorkflowRegistry;

    $config = [
        'straight'   => [
            'supports'      => ['Tests\Fixtures\TestObject'],
            'places'        => ['a', 'b', 'c'],
            'transitions'   => [
                't1' => [
                    'from' => 'a',
                    'to'   => 'b',
                ],
                't2' => [
                    'from' => 'b',
                    'to'   => 'c',
                ],
            ],
        ],
    ];

    class Workflow
    {
        public static function get($object, $name)
        {
            global $config;

            $workflowRegistry = new WorkflowRegistry($config);

            return $workflowRegistry->get($object, $name);
        }
    }

    class Config
    {
        public static function get($name)
        {
            global $config;

            return $config;
        }
    }
}
