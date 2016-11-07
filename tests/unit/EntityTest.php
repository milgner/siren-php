<?php declare(strict_types=1);

namespace tests\unit\TomPHP\Siren;

use TomPHP\Siren\Entity;

final class EntityTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function on_getClasses_it_returns_the_classes()
    {
        $entity = Entity::builder()
            ->addClass('class-a')
            ->addClass('class-b')
            ->build();

        assertSame(['class-a', 'class-b'], $entity->getClasses());
    }

    /** @test */
    public function on_getClasses_return_only_one_of_each_class()
    {
        $entity = Entity::builder()
            ->addClass('class-a')
            ->addClass('class-a')
            ->build();

        assertSame(['class-a'], $entity->getClasses());
    }

    /** @test */
    public function on_hasClass_it_returns_false_if_the_class_is_not_present()
    {
        $entity = Entity::builder()
            ->build();

        assertFalse($entity->hasClass('example-class'));
    }

    /** @test */
    public function on_hasClass_it_returns_true_if_the_class_is_present()
    {
        $entity = Entity::builder()
            ->addClass('example-class')
            ->build();

        assertTrue($entity->hasClass('example-class'));
    }

    /** @test */
    public function it_converts_to_an_array()
    {
        $entity = Entity::builder()
            ->addClass('example-class')
            ->addProperties([
                'a' => 1,
                'b' => 2,
            ])
            ->build();

        assertSame(
            [
                'class' => ['example-class'],
                'properties' => [
                    'a' => 1,
                    'b' => 2,
                ],
            ],
            $entity->toArray()
        );
    }
}
