<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Contracts\Auth\Guard;

class Role
{
	protected $auth;


	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}


	public function handle($request, Closure $next, $unlimited_roles = null,$limited_roles = null)
	{
		$unlimited_roles = explode('|', trim($unlimited_roles,'[]'));
		$limited_roles = explode('|', trim($limited_roles,'[]'));
		$user_role_name = $request->user()->hasAnyRole(array_merge($unlimited_roles,$limited_roles));
		if ($this->auth->guest() || !$user_role_name || ($user_role_name && in_array($user_role_name, $limited_roles, true) && intval($request->id) !== $request->user()->id) ) {
			return response()->json(
				[
				  'error'=>[[
					  'code'=>6000,
				      'title'=>trans('general.core.Unauthorized'),
                      'desc'=>trans('general.core.Unauthorized')
				  ]]
				]
			  ,Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		return $next($request);
	}
	
}
