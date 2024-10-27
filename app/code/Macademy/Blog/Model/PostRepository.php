<?php
declare(strict_types = 1);

namespace Macademy\Blog\Model;
use http\Exception;
use Macademy\Blog\Api\Data\PostInterface;
use Macademy\Blog\Api\PostRepositoryInterface;
use Macademy\Blog\Model\ResourceModel\Post as PostResourceModel;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;

class PostRepository implements PostRepositoryInterface{
    public function __construct(
        private PostFactory $postFactory,
        private PostResourceModel $postResourceModel,
    ){}

    public function getById(int $id): PostInterface
    {
        $post = $this->postFactory->create();
        $this->postResourceModel->load($post, $id);
        if(!$post->getID()){
            throw new noSuchEntityException(__('the blog post with "%1" doesn\t exist.',));
        }
        return $post;
    }

    public function save(PostInterface $post): PostInterface
    {
        try{
            $this->postResourceModel->save($post);

        }catch(\Exception $exception){
throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $post;
    }

    public function deleteById(int $id): bool
    {
      $post =  $this->getById($id);
        try {
            $this->postResourceModel->delete($post);
        }catch (\Exception $exception){
         throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }
}
