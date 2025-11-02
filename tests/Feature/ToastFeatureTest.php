<?php

namespace IslamAlsayed\LaravelToasts\Tests\Feature;

use IslamAlsayed\LaravelToasts\Tests\TestCase;
use IslamAlsayed\LaravelToasts\Toast;

class ToastFeatureTest extends TestCase
{
    public function test_add_toast_helper_adds_to_session()
    {
        addToast('success', 'Test message');

        $toasts = session('toasts');

        $this->assertNotNull($toasts);
        $this->assertIsArray($toasts);
        $this->assertCount(1, $toasts);
        $this->assertEquals('success', $toasts[0]->type);
        $this->assertEquals('Test message', $toasts[0]->message);
    }

    public function test_add_toast_success_helper()
    {
        addToastSuccess('User created!');

        $toasts = session('toasts');

        $this->assertEquals('success', $toasts[0]->type);
        $this->assertEquals('User created!', $toasts[0]->message);
    }

    public function test_add_toast_error_helper()
    {
        addToastError('Something failed!');

        $toasts = session('toasts');

        $this->assertEquals('error', $toasts[0]->type);
        $this->assertEquals('Something failed!', $toasts[0]->message);
    }

    public function test_add_toast_warning_helper()
    {
        addToastWarning('Check your input');

        $toasts = session('toasts');

        $this->assertEquals('warning', $toasts[0]->type);
        $this->assertEquals('Check your input', $toasts[0]->message);
    }

    public function test_add_toast_info_helper()
    {
        addToastInfo('Did you know?');

        $toasts = session('toasts');

        $this->assertEquals('info', $toasts[0]->type);
        $this->assertEquals('Did you know?', $toasts[0]->message);
    }

    public function test_add_confirm_helper()
    {
        addConfirm('Are you sure?');

        $toasts = session('toasts');

        $this->assertEquals('confirm', $toasts[0]->type);
        $this->assertEquals('Are you sure?', $toasts[0]->message);
    }

    public function test_add_confirm_success_helper()
    {
        addConfirmSuccess('Save changes?');

        $toasts = session('toasts');

        $this->assertEquals('confirm', $toasts[0]->type);
        $this->assertEquals('success', $toasts[0]->theme);
        $this->assertEquals('Save changes?', $toasts[0]->message);
    }

    public function test_add_confirm_error_helper()
    {
        addConfirmError('Delete permanently?');

        $toasts = session('toasts');

        $this->assertEquals('confirm', $toasts[0]->type);
        $this->assertEquals('error', $toasts[0]->theme);
        $this->assertEquals('Delete permanently?', $toasts[0]->message);
    }

    public function test_multiple_toasts_can_be_queued()
    {
        addToastSuccess('First');
        addToastError('Second');
        addToastWarning('Third');
        addToastInfo('Fourth');

        $toasts = session('toasts');

        $this->assertCount(4, $toasts);
        $this->assertEquals('success', $toasts[0]->type);
        $this->assertEquals('error', $toasts[1]->type);
        $this->assertEquals('warning', $toasts[2]->type);
        $this->assertEquals('info', $toasts[3]->type);
    }

    public function test_toast_with_chained_methods()
    {
        addToast('success', 'Saved!')
            ->title('Success')
            ->emoji('🎉')
            ->icon('check')
            ->pin()
            ->duration('5s')
            ->position('top')
            ->dir('rtl')
            ->theme('custom');

        $toasts = session('toasts');
        $toast = $toasts[0];

        $this->assertEquals('Success', $toast->title);
        $this->assertEquals('🎉', $toast->emoji);
        $this->assertEquals('check', $toast->icon);
        $this->assertTrue($toast->pin);
        $this->assertEquals('5s', $toast->duration);
        $this->assertEquals('top', $toast->position);
        $this->assertEquals('rtl', $toast->dir);
        $this->assertEquals('custom', $toast->theme);
    }

    public function test_toast_with_actions()
    {
        addToast('info', 'New message')
            ->withAction('View', '/messages')
            ->withAction('Dismiss', '#');

        $toasts = session('toasts');
        $toast = $toasts[0];

        $this->assertIsArray($toast->actions);
        $this->assertCount(2, $toast->actions);
        $this->assertEquals('View', $toast->actions[0]['label']);
        $this->assertEquals('/messages', $toast->actions[0]['url']);
    }

    public function test_confirmation_with_custom_buttons()
    {
        addConfirm('Delete this item?')
            ->link('/delete/1')
            ->onConfirm('Yes, Delete')
            ->onCancel('No, Keep');

        $toasts = session('toasts');
        $toast = $toasts[0];

        $this->assertEquals('/delete/1', $toast->link);
        $this->assertEquals('Yes, Delete', $toast->confirm);
        $this->assertEquals('No, Keep', $toast->cancel);
    }

    public function test_session_flash_creates_toast()
    {
        session()->flash('success', 'Flash message!');

        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Flash message!', session('success'));
    }

    public function test_toasts_can_be_pulled_from_session()
    {
        addToastSuccess('Test');

        $toasts = session()->pull('toasts', []);

        $this->assertNotEmpty($toasts);
        $this->assertCount(1, $toasts);

        // After pull, session should be empty
        $empty = session('toasts', []);
        $this->assertEmpty($empty);
    }

    public function test_toast_instance_is_correct_type()
    {
        addToast('warning', 'Test warning');

        $toasts = session('toasts');

        $this->assertInstanceOf(Toast::class, $toasts[0]);
    }

    public function test_emoji_replaces_icon_when_set()
    {
        $toast = addToast('success', 'Test')
            ->icon('check')
            ->emoji('✅');

        $this->assertEquals('✅', $toast->emoji);
        $this->assertEquals('check', $toast->icon);
    }
}
