<?php
declare(strict_types=1);

namespace Macademy\Blog\Controller\Index;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\RequestInterface;
use Macademy\Blog\Model\PostRepository;




class Index implements HttpGetActionInterface{

    public function __construct(
        private PageFactory $pageFactory,
        private PostRepository $postRepository,
    ){}

    public function execute(): Page
    {
        return $this->pageFactory->create();
    }

}

