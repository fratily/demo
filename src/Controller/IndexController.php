<?php
namespace App\Controller;

use Fratily\Router\Annotation\Route;

/**
 *
 */
class IndexController extends \Fratily\Bundle\Framework\Controller\AbstractController{

    /**
     * @Route(
     *  path="/",
     *  host="*",
     *  methods={"GET", "POST"},
     *  name="index"
     * )
     */
    public function index(){
        return $this->render("index.html.twig");
    }

    /**
     * @Route(
     *  path="/exception",
     *  host="*",
     *  methods={"GET"},
     *  name="exception"
     * )
     */
    public function exception(){
        try{
            $this->_exception();
        }catch(\Exception $e){
            throw new \Exception("Exception is thrown.", 0, $e);
        }
    }

    public function _exception(){
        throw new \LogicException("Logic exception is thrown.");
    }

    /**
     * @Route(
     *  path="example/:id@int",
     *  host="fratily.local"
     * )
     */
    public function example(int $id){
        $response   = $this->generateResponse(200);
        $response->getBody()->write("example...{$id}");

        return $response;
    }
}
