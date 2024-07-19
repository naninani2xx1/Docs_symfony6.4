<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\WebLink\Link;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(Request $request, KernelInterface $kernel): Response
    {
        $package = new Package(new JsonManifestVersionStrategy($kernel->getProjectDir().'/public/assets/manifest.json'));
        // Tạo URL cho tệp CSS bằng asset mapper
        $cssUrl = $package->getUrl('styles/app.css');
        // Thêm liên kết preload cho tệp CSS
        $this->addLink($request, (new Link('preload', $cssUrl))->withAttribute('as', 'style'));
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
