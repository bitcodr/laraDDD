<?php  namespace App\Providers;

use Dingo\Api\Exception\Handler;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Exceptions\{UserNotDefinedException,TokenInvalidException,TokenExpiredException};
use Symfony\Component\HttpKernel\Exception\{UnsupportedMediaTypeHttpException,ServiceUnavailableHttpException,MethodNotAllowedHttpException,TooManyRequestsHttpException,UnauthorizedHttpException,AccessDeniedHttpException,BadRequestHttpException,NotFoundHttpException,ConflictHttpException,HttpException};

class ExceptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        app(Handler::class)->register(function (UnauthorizedHttpException $e) {
            return $this->exception(7000,'UnauthorizedHttpException');
        });

        app(Handler::class)->register(function (AuthenticationException $e) {
            return $this->exception(7000,'AuthenticationException');
        });

        app(Handler::class)->register(function (AuthorizationException $e) {
            return $this->exception(7000,'AuthorizationException');
        });
        
        app(Handler::class)->register(function (TokenInvalidException $e) {
            return $this->exception(7000,'TokenInvalidException');
        });
        
        app(Handler::class)->register(function (TokenExpiredException $e) {
            return $this->exception(7000,'TokenExpiredException');
        });
        
        app(Handler::class)->register(function (UserNotDefinedException $e) {
            return $this->exception(7000,'UserNotDefinedException');
        });

        app(Handler::class)->register(function (AccessDeniedHttpException $e) {
            return $this->exception(7000,'AccessDeniedHttpException');
        });

        app(Handler::class)->register(function (ModelNotFoundException $e) {
            return $this->exception(7000,'ModelNotFoundException');
        });

        app(Handler::class)->register(function (NotFoundHttpException $e) {
            $this->exception(404,'NotFoundHttpException');
        });

        app(Handler::class)->register(function (ConflictHttpException $e) {
            return $this->exception(409,'ConflictHttpException');
        });

        app(Handler::class)->register(function (MethodNotAllowedHttpException $e) {
            return $this->exception(405,'MethodNotAllowedHttpException');
        });

        app(Handler::class)->register(function (TooManyRequestsHttpException $e) {
            return $this->exception(429,'TooManyRequestsHttpException');
        });

        app(Handler::class)->register(function (BadRequestHttpException $e) {
            return $this->exception(400,'BadRequestHttpException');
        });

        app(Handler::class)->register(function (ServiceUnavailableHttpException $e) {
            return $this->exception(503,'ServiceUnavailableHttpException');
        });

        app(Handler::class)->register(function (UnsupportedMediaTypeHttpException $e) {
            return $this->exception(415,'UnsupportedMediaTypeHttpException');
        });
    }

    

    private function exception($code, $message)
    {
        return response()->json(
            [
              'error'=>[[
                  'code'=>$code,
                  'title'=>$message,
                  'desc'=>trans('general.core.'.$message)
              ]]
             ]
          ,422);
    }



    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }


}
