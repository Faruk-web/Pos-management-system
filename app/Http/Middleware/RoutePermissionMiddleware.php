<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoutePermissionMiddleware
{
    use  \App\Permissions\RoutePermissions;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if($this->isAdminDashboard($request)){

            return $next($request);

        }else if($this->isProductPermission($request)){

            return $next($request);

        }else if($this->isBrandCategoryListPermission($request)){

            return $next($request);

        }else if($this->isSetRolePermission($request)){

            return $next($request);

        }else if($this->isSoftwareSettingsPermission($request)){

            return $next($request);

        }else if($this->isPosPermission($request)){

            return $next($request);

        }else if($this->isOrderPermission($request)){

            return $next($request);

        }else if($this->isExpensePermission($request)){

            return $next($request);

        }else if($this->isEmployeePermission($request)){

            return $next($request);

        }else if($this->isStockPermission($request)){

            return $next($request);

        }

        // 25/07/2022

        else if($this->isAgentPanelPermissions($request)){

            return $next($request);

        }else if($this->isReportsPermissions($request)){

            return $next($request);
        }else if($this->isSalaryPermissions($request)){

            return $next($request);

        }else if($this->isCouponsPermissions($request)){

            return $next($request);

        }else if($this->isWebSettingsPermissions($request)){

            return $next($request);

        }else if($this->isSuppliersPanelPermissions($request)){

            return $next($request);

        }else if($this->isSliderPermissions($request)){

            return $next($request);
        }else if($this->isCustomerReturnOrdersPermissions($request)){

            return $next($request);
        }
        else if($this->isCustomerPermissions($request)){

            return $next($request);
        }
        return redirect()->back()->with('error',"You have no permission to access this route.");
        // return $next($request);
    }
}
