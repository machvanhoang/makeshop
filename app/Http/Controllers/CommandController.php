<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CommandController extends Controller
{
    /**
     * Summary of index
     *
     * @param Request $request
     * @return Factory|View|RedirectResponse
     */
    public function index(Request $request)
    {
        if ('POST' === $request->getMethod()) {
            $command = $request->get('actions') ? $request->get('actions') : null;
            if (!is_null($command)) {
                switch ($command) {
                    case 'config':
                        Artisan::call('config:clear');
                        break;
                    case 'cache':
                        Artisan::call('cache:clear');
                        break;
                    case 'optimize':
                        Artisan::call('optimize');
                        break;
                    case 'view':
                        Artisan::call('view:clear');
                        break;
                    default:
                        break;
                }
                return redirect()->route('command.index')->with('_alert_command', __('操作成功!!!'));
            }
        }
        return view(
            'command',
        );
    }
}
