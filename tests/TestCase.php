<?php


use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Laravel\Lumen\Application;
use Laravel\Lumen\Testing\DatabaseMigrations;

abstract class TestCase extends Laravel\Lumen\Testing\TestCase {

    use DatabaseMigrations;

    private $oldExceptionHandler;

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication() {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function setUp(): void {
        parent::setUp();
        $this->artisan('db:seed');
    }

    protected function withoutExceptionHandling() {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {
            }

            public function report(Throwable $e) {
            }

            public function render($request, Throwable $e) {
                throw $e;
            }
        });
    }

    protected function withExceptionHandling() {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }

    protected function sessionContent($response) {
        return $response->response->getOriginalContent() ?? null;
    }

    protected function getContent($response) {
        return (json_decode($response->response->getContent()));
    }

}
