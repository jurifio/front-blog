<?php

namespace bamboo\blog\controllers;

use bamboo\core\router\ARootController;
use bamboo\core\router\CInternalRequest;
use bamboo\core\asset\CAssetCollection;
use bamboo\core\router\CHub;
use bamboo\ecommerce\views\VBase;
use bamboo\core\theming\CWidgetHelper;

/**
 * Class CBlogHomepageController
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
class CBlogHomepageController extends ARootController
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
        $view->setAssets($ac,'bloghome',$this->app);
        $view->setHeadTags($this->app->getBubbledObj('headTags'));
        return $view->render([
            'app' =>  new CWidgetHelper($this->app)
        ]);
    }
}