<?php

namespace IslamAlsayed\LaravelToasts\Tests\Unit;

use IslamAlsayed\Toasts\Toast;
use IslamAlsayed\Toasts\ToastManager;
use IslamAlsayed\LaravelToasts\Tests\TestCase;

class ToastManagerTest extends TestCase
{
    protected $manager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->manager = new ToastManager();
    }

    public function test_can_add_toast_to_session()
    {
        $this->manager->add('success', 'Test message');

        $toasts = session('toasts');

        $this->assertNotNull($toasts);
        $this->assertIsArray($toasts);
        $this->assertCount(1, $toasts);
        $this->assertInstanceOf(Toast::class, $toasts[0]);
        $this->assertEquals('success', $toasts[0]->type);
        $this->assertEquals('Test message', $toasts[0]->message);
    }

    public function test_can_add_multiple_toasts()
    {
        $this->manager->add('success', 'First message');
        $this->manager->add('error', 'Second message');
        $this->manager->add('warning', 'Third message');

        $toasts = session('toasts');

        $this->assertCount(3, $toasts);
        $this->assertEquals('success', $toasts[0]->type);
        $this->assertEquals('error', $toasts[1]->type);
        $this->assertEquals('warning', $toasts[2]->type);
    }

    public function test_toast_returns_toast_instance()
    {
        $toast = $this->manager->add('info', 'Information');

        $this->assertInstanceOf(Toast::class, $toast);
        $this->assertEquals('info', $toast->type);
        $this->assertEquals('Information', $toast->message);
    }

    public function test_can_chain_methods_after_add()
    {
        $this->manager->add('success', 'Saved!')
            ->title('Success')
            ->emoji('✅')
            ->pin();

        $toasts = session('toasts');

        $this->assertEquals('Success', $toasts[0]->title);
        $this->assertEquals('✅', $toasts[0]->emoji);
        $this->assertTrue($toasts[0]->pin);
    }

    public function test_session_toasts_are_arrays()
    {
        $this->manager->add('success', 'First');
        $this->manager->add('error', 'Second');

        $toasts = session('toasts');

        $this->assertIsArray($toasts);
        $this->assertContainsOnlyInstancesOf(Toast::class, $toasts);
    }

    public function test_toasts_persist_across_multiple_adds()
    {
        // First add
        $this->manager->add('success', 'One');
        $this->assertCount(1, session('toasts'));

        // Second add - should append
        $this->manager->add('error', 'Two');
        $this->assertCount(2, session('toasts'));

        // Third add - should append
        $this->manager->add('warning', 'Three');
        $this->assertCount(3, session('toasts'));
    }

    public function test_can_create_confirmation_toast()
    {
        $this->manager->add('confirm', 'Are you sure?');

        $toasts = session('toasts');

        $this->assertEquals('confirm', $toasts[0]->type);
        $this->assertEquals('Are you sure?', $toasts[0]->message);
    }

    public function test_empty_session_returns_empty_array()
    {
        $toasts = session('toasts', []);

        $this->assertIsArray($toasts);
        $this->assertEmpty($toasts);
    }
}