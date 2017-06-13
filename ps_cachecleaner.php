<?php

if (!defined('_PS_VERSION_'))
    exit;

class Ps_CacheCleaner extends Module
{

    protected $cleanedCache = false;

    public function __construct()
    {
        $this->name = 'ps_cachecleaner';
        $this->author = 'tonyyb';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Cache cleaner');
        $this->description = $this->l('Clean all the website cache.');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function getContent()
    {
        $this->postProcess();

        $this->context->smarty->assign(
            array(
                'clearCacheUrl' => 'index.php?tab=AdminModules&configure='.$this->name.'&clean_cache&token='.Tools::getAdminToken('AdminModules'.(int) Tab::getIdFromClassName('AdminModules').(int) $this->context->employee->id),
                'cleanedCache' => $this->cleanedCache,
            )
        );

        return $this->display(__FILE__, 'views/templates/admin/view.tpl');
    }

    protected function postProcess()
    {
        if (Tools::isSubmit('clean_cache')) {
            $this->clearTheCache();
        }
    }

    protected function clearTheCache()
    {
        //Clear the cache
        Tools::clearSmartyCache();
        Tools::clearXMLCache();
        Media::clearCache();
        Tools::generateIndex();
        // PS >= 1.7
        if (method_exists('Tools', 'empty_sf2_cache')) {
            Tools::empty_sf2_cache();
        }
        $this->cleanedCache = true;
    }

}
