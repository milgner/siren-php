<?php declare(strict_types=1);

namespace TomPHP\Siren;

final class EntityBuilder
{
    /**
     * @var string[]
     */
    private $classes = [];

    /**
     * @var array
     */
    private $properties = [];

    /**
     * @var Link[]
     */
    private $links = [];

    /**
     * @var string
     */
    private $title;

    /**
     * @return $this
     */
    public function addClass(string $name)
    {
        $this->classes[] = $name;

        return $this;
    }

    /**
     * @return $this
     */
    public function addProperties(array $properties)
    {
        $this->properties = array_merge(
            $this->properties,
            $properties
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function addProperty(string $name, $value)
    {
        $this->properties[$name] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param Link|string|string[] $linkOrRel
     * @param string               $href
     * @param string|string[]      $classes
     * @param string               $title
     * @param string               $type
     *
     * @return $this
     */
    public function addLink(
        $linkOrRel,
        string $href = null,
        $classes = [],
        string $title = null,
        string $type = null
    ) {
        $link = $linkOrRel;

        if (!$linkOrRel instanceof Link) {
            $rels    = is_array($linkOrRel) ? $linkOrRel : [$linkOrRel];
            $classes = is_array($classes) ? $classes : [$classes];
            $link    = new Link($rels, $href, $classes, $title, $type);
        }

        $this->links[] = $link;

        return $this;
    }

    public function build() : Entity
    {
        return new Entity(
            $this->classes,
            $this->properties,
            $this->links,
            $this->title
        );
    }
}
