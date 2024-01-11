<?php
global $gi, $Gtk, $WebKit2;

$gi      = vrzno_env('gi');
$Gtk     = vrzno_env('Gtk');
$WebKit2 = vrzno_env('WebKit2');

function url($href)
{
    return preg_match('/^([a-z]{2,}):/', $href) ? $href : ('http://' . $href);
}

function load($href, $webView, $urlBar)
{
    $url = url($href);
    $webView->loadUri($url);
    $urlBar->setText($url);
}

$gi->startLoop();
$Gtk->init();

$window  = new $Gtk->Window;
$toolbar = new $Gtk->Toolbar;
$webView = new $WebKit2->WebView();

$buttonBack    = $Gtk->ToolButton->newFromStock($Gtk->STOCK_GO_BACK);
$buttonForward = $Gtk->ToolButton->newFromStock($Gtk->STOCK_GO_FORWARD);
$buttonRefresh = $Gtk->ToolButton->newFromStock($Gtk->STOCK_REFRESH);

$urlBar = new $Gtk->Entry();
$scrolledWindow = new $Gtk->ScrolledWindow;

$hBox = new $Gtk->Box((object)['orientation' => $Gtk->Orientation->HORIZONTAL]);
$vBox = new $Gtk->Box((object)['orientation' => $Gtk->Orientation->VERTICAL]);

$scrolledWindow->add($webView);

$toolbar->add($buttonBack);
$toolbar->add($buttonForward);
$toolbar->add($buttonRefresh);

$hBox->packStart($toolbar, false, false, 0);
$hBox->packStart($urlBar, true, true, 0);

$vBox->packStart($hBox, false, true, 0);
$vBox->packStart($scrolledWindow, true, true, 0);

$window->setDefaultSize(1024, 720);
$window->setResizable(true);
$window->add($vBox);

$gtkSettings = $Gtk->Settings->getDefault();
$gtkSettings->gtkApplicationPreferDarkTheme = true;
$gtkSettings->gtkThemeName = 'Adwaita';

$webSettings = $webView->getSettings();
$webSettings->enableDeveloperExtras = true;
$webSettings->enableCaretBrowsing = true;

$buttonBack->on('clicked', fn() => $webView->goBack());
$buttonForward->on('clicked', fn() => $webView->goForward());
$buttonRefresh->on('clicked', fn() => $webView->reload());

$urlBar->on('activate', fn() => load($urlBar->getText(), $webView, $urlBar));
$webView->on('load-changed', fn() => $urlBar->setText($webView->getUri()));
$window->on('show', fn() => load('https://php-cloud.pages.dev', $webView, $urlBar));

$window->on('delete-event', fn() => false);
$window->on('destroy', fn() => $Gtk->mainQuit());

$window->setTitle('PHP-GTK Browser');

$window->setPosition($Gtk->WindowPosition->CENTER);

$window->showAll();
$Gtk->main();

$gi            = NULL;
$Gtk           = NULL;
$WebKit2       = NULL;

$window        = NULL;
$toolbar       = NULL;
$webView       = NULL;

$buttonBack    = NULL;
$buttonForward = NULL;
$buttonRefresh = NULL;

$urlBar        = NULL;
$scrolledWindow = NULL;

$hBox          = NULL;
$vBox          = NULL;

$gtkSettings   = NULL;
$webSettings   = NULL;

gc_collect_cycles();

echo "Done.\n";