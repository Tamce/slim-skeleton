<?php
namespace App\Modules\Auth;

class Meta implements \ElfStack\SlimModule\Interfaces\ModuleInfoInterface
{
    static public function info(): \ElfStack\SlimModule\MetaInfo
    {
        return new \ElfStack\SlimModule\MetaInfo('auth', [
            'namespace' => 'App\Modules\Auth',
            'api_prefix' => '',
            'apis' => [
                'GET /' => self::class.':test'
            ],
            'services' => [
                'foo' => 'Meta:foo'
            ]
        ]);
    }

    public function foo($arg1, $arg2)
    {
        return "Foo Service: $arg1, $arg2";
    }
    public function test($request, $response)
    {
        $data = app('module')->call('auth.foo', 'bar', 'baz');
        return $response->write('Hello from controller, data from service foo: '.$data);
    }
}