<?php
use App\Post;
use App\User;
use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

require __DIR__ . '/vendor/autoload.php';

AnnotationRegistry::registerLoader('class_exists');

function getUser() {
    $user = new User();
    $user->name = 'user1';

    for ($i = 0; $i < 2; $i++) {
        $post = new Post();
        $post->title = 'post' . ($i + 1);
        $post->user = clone $user;
        $user->posts[] = $post;
    }

    return $user;
}

$serializer = SerializerBuilder::create()
    ->setSerializationContextFactory(function () {
        return SerializationContext::create()
            ->enableMaxDepthChecks()
            ->setSerializeNull(true)
        ;
    })
    ->build()
;

$json = $serializer->serialize(getUser(), 'json');

echo $json;
