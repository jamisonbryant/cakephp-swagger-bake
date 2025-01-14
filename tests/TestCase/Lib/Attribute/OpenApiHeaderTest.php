<?php


namespace SwaggerBake\Test\TestCase\Lib\Annotations;

use Cake\Routing\Router;
use Cake\Routing\RouteBuilder;
use Cake\TestSuite\TestCase;

use SwaggerBake\Lib\Attribute\AbstractOpenApiParameter;
use SwaggerBake\Lib\Attribute\OpenApiHeader;
use SwaggerBake\Lib\Exception\SwaggerBakeRunTimeException;
use SwaggerBake\Lib\Model\ModelScanner;
use SwaggerBake\Lib\Route\RouteScanner;
use SwaggerBake\Lib\Configuration;
use SwaggerBake\Lib\Swagger;

class OpenApiHeaderTest extends TestCase
{
    /**
     * @var string[]
     */
    public $fixtures = [
        'plugin.SwaggerBake.Employees',
    ];

    private Router $router;

    private Configuration $config;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function test(): void
    {
        $this->__setUp();
        $cakeRoute = new RouteScanner($this->router, $this->config);

        $swagger = new Swagger(new ModelScanner($cakeRoute, $this->config), $this->config);
        $arr = json_decode($swagger->toString(), true);

        $this->assertArrayHasKey('/employees/custom-get', $arr['paths']);
        $this->assertArrayHasKey('get', $arr['paths']['/employees/custom-get']);
        $operation = $arr['paths']['/employees/custom-get']['get'];

        $this->assertCount(1, array_filter($operation['parameters'], function ($param) {
            return $param['name'] == 'X-HEAD-ATTRIBUTE';
        }));
    }

    public function test_constructor_expect_exception_from_missing_name_and_ref(): void
    {
        $this->expectException(SwaggerBakeRunTimeException::class);
        new OpenApiHeader();
    }

    public function test_constructor_expect_exception_from_invalid_type(): void
    {
        $this->expectException(SwaggerBakeRunTimeException::class);
        new OpenApiHeader(name: 'Name', type: 'invalid');
    }

    /**
     * @see AbstractOpenApiParameter
     */
    public function test_create(): void
    {
        $parameter = (new OpenApiHeader('name'))->createParameter();
        $this->assertEquals('header', $parameter->getIn());
    }

    private function __setUp(): void
    {
        $router = new Router();
        $router::scope('/', function (RouteBuilder $builder) {
            $builder->setExtensions(['json']);
            $builder->resources('Employees', [
                'map' => [
                    'customGet' => [
                        'action' => 'customGet',
                        'method' => 'GET',
                        'path' => 'custom-get'
                    ],
                ]
            ]);
        });
        $this->router = $router;

        $this->config = new Configuration([
            'prefix' => '/',
            'yml' => '/config/swagger-bare-bones.yml',
            'json' => '/webroot/swagger.json',
            'webPath' => '/swagger.json',
            'hotReload' => false,
            'exceptionSchema' => 'Exception',
            'requestAccepts' => ['application/x-www-form-urlencoded'],
            'responseContentTypes' => ['application/json'],
            'namespaces' => [
                'controllers' => ['\SwaggerBakeTest\App\\'],
                'entities' => ['\SwaggerBakeTest\App\\'],
                'tables' => ['\SwaggerBakeTest\App\\'],
            ]
        ], SWAGGER_BAKE_TEST_APP);
    }
}