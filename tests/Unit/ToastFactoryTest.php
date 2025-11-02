<?php

namespace IslamAlsayed\LaravelToasts\Tests\Unit;

use IslamAlsayed\Toasts\ToastFactory;
use IslamAlsayed\LaravelToasts\Tests\TestCase;

class ToastFactoryTest extends TestCase
{
    public function test_can_create_success_toast()
    {
        $toast = ToastFactory::success('User created successfully!');

        $this->assertEquals('success', $toast->type);
        $this->assertEquals('User created successfully!', $toast->message);
        $this->assertNull($toast->title);
    }

    public function test_can_create_error_toast()
    {
        $toast = ToastFactory::error('Something went wrong!');

        $this->assertEquals('error', $toast->type);
        $this->assertEquals('Something went wrong!', $toast->message);
    }

    public function test_can_create_warning_toast()
    {
        $toast = ToastFactory::warning('Please check your input');

        $this->assertEquals('warning', $toast->type);
        $this->assertEquals('Please check your input', $toast->message);
    }

    public function test_can_create_info_toast()
    {
        $toast = ToastFactory::info('Did you know?');

        $this->assertEquals('info', $toast->type);
        $this->assertEquals('Did you know?', $toast->message);
    }

    public function test_can_set_title()
    {
        $toast = ToastFactory::success('Message')->title('Success');

        $this->assertEquals('Success', $toast->title);
    }

    public function test_can_set_emoji()
    {
        $toast = ToastFactory::success('Message')->emoji('🎉');

        $this->assertEquals('🎉', $toast->emoji);
    }

    public function test_can_set_icon()
    {
        $toast = ToastFactory::error('Message')->icon('bomb');

        $this->assertEquals('bomb', $toast->icon);
    }

    public function test_can_set_duration()
    {
        $toast = ToastFactory::info('Message')->duration('5s');

        $this->assertEquals('5s', $toast->duration);
    }

    public function test_can_set_position()
    {
        $toast = ToastFactory::success('Message')->position('top');

        $this->assertEquals('top', $toast->position);
    }

    public function test_can_pin_toast()
    {
        $toast = ToastFactory::warning('Message')->pin();

        $this->assertTrue($toast->pin);
    }

    public function test_can_set_theme()
    {
        $toast = ToastFactory::info('Message')->theme('custom');

        $this->assertEquals('custom', $toast->theme);
    }

    public function test_can_set_direction()
    {
        $toast = ToastFactory::success('Message')->dir('rtl');

        $this->assertEquals('rtl', $toast->dir);
    }

    public function test_can_add_actions()
    {
        $toast = ToastFactory::info('New message')
            ->withAction('View', '/messages')
            ->withAction('Dismiss', '#');

        $this->assertIsArray($toast->actions);
        $this->assertCount(2, $toast->actions);
        $this->assertEquals('View', $toast->actions[0]['label']);
        $this->assertEquals('/messages', $toast->actions[0]['url']);
        $this->assertEquals('Dismiss', $toast->actions[1]['label']);
        $this->assertEquals('#', $toast->actions[1]['url']);
    }

    public function test_can_chain_multiple_methods()
    {
        $toast = ToastFactory::error('Failed to save!')
            ->title('Error')
            ->emoji('❌')
            ->icon('bomb')
            ->pin()
            ->duration('5s')
            ->position('top')
            ->dir('ltr')
            ->theme('error')
            ->withAction('Retry', '/retry')
            ->withAction('Cancel', '/cancel');

        $this->assertEquals('error', $toast->type);
        $this->assertEquals('Failed to save!', $toast->message);
        $this->assertEquals('Error', $toast->title);
        $this->assertEquals('❌', $toast->emoji);
        $this->assertEquals('bomb', $toast->icon);
        $this->assertTrue($toast->pin);
        $this->assertEquals('5s', $toast->duration);
        $this->assertEquals('top', $toast->position);
        $this->assertEquals('ltr', $toast->dir);
        $this->assertEquals('error', $toast->theme);
        $this->assertCount(2, $toast->actions);
    }

    public function test_can_create_confirmation_toast()
    {
        $toast = ToastFactory::confirm('Are you sure?');

        $this->assertEquals('confirm', $toast->type);
        $this->assertEquals('Are you sure?', $toast->message);
    }

    public function test_can_set_confirmation_link()
    {
        $toast = ToastFactory::confirm('Delete this?')->link('/delete/1');

        $this->assertEquals('/delete/1', $toast->link);
    }

    public function test_can_set_confirm_and_cancel_text()
    {
        $toast = ToastFactory::confirm('Proceed?')
            ->onConfirm('Yes, do it')
            ->onCancel('No, cancel');

        $this->assertEquals('Yes, do it', $toast->confirm);
        $this->assertEquals('No, cancel', $toast->cancel);
    }

    public function test_can_set_target_attribute()
    {
        $toast = ToastFactory::confirm('Open link?')
            ->link('https://example.com')
            ->target('_blank');

        $this->assertEquals('_blank', $toast->target);
    }
}