<?php

namespace bamboo\blog\controllers;

use bamboo\core\router\ARootController;
use bamboo\core\router\CInternalRequest;
use bamboo\core\asset\CAssetCollection;
use bamboo\core\router\CHub;
use bamboo\ecommerce\views\VBase;
use bamboo\core\theming\CWidgetHelper;

/**
 * Class CBlogSingleController
 * @package bamboo\front\site\controllers
 *
 * @author Bambooshoot Team <emanuele@bambooshoot.agency>
 *
 * @copyright (c) Bambooshoot snc - All rights reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * @date 18/04/2016
 * @since 1.0
 */

// blog/dev.routes.json per i post singoli una volta che sarà implementata la repo
//    {
//        "pattern": "/:loc/blog/:postTitle/:postId",
//            "behaviour": {},
//            "filters": {
//        "loc": "[a-z]{2}",
//                "postTitle": "[a-zA-Z0-9-_]{255}",
//                "postId": "[0-9]+"
//            },
//            "translations": {},
//            "methods": [
//        "GET"
//    ]
//        }







// CContent.blogSingle data
//"data": {
//    "default": {
//        "src": "mixed",
//                "repository": "Post",
//                "type": "entity",
//                "method": "Id",
//                "params": ["postId","postTitle"],
//                "args": [],
//                "sorting": [],
//                "offset": "0",
//                "limit": "9"
//            }
//        },
class CBlogSingleController extends ARootController
{
    public function createAction($action)
    {
        $this->app->authManager->auth();
        $filters = $this->app->router->getMatchedRoute()->getComputedFilters();

        $request = new CInternalRequest("CBlogSingle.default",$filters['loc'],$filters,$this->app->router->request()->getMethod(),$action);
        return $this->{$action}($request);
    }

    /**
     * @param CInternalRequest $request
     * @return string
     * @throws \bamboo\core\exceptions\RedPandaInvalidArgumentException
     */
    public function get(CInternalRequest $request)
    {
        $ac = new CAssetCollection();
        $hub = new CHub($request,$this->app,$ac);

        $view = new VBase($hub->dispatch());
        $view->setTemplatePath($this->app->rootPath().$this->app->cfg()->fetch('paths','store-theme').'/widgets/document.php');
        $view->setAssets($ac,'blogsingle',$this->app);
        $view->setHeadTags($this->app->getBubbledObj('headTags'));
        return $view->render([
            'app' =>  new CWidgetHelper($this->app)
        ]);
    }
}