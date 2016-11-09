<?php declare(strict_types=1);

namespace TomPHP\Siren;

final class Link
{
    /**
     * @var string[]
     */
    private $rels;

    /**
     * @var string
     */
    private $href;

    /**
     * @var string[]
     */
    private $classes;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $type;

    /**
     * @param string[] $rels
     * @param string   $href
     * @param string[] $classes
     * @param string   $title
     * @param string   $type
     */
    public function __construct(
        array $rels,
        string $href,
        array $classes = [],
        string $title = null,
        string $type = null
    ) {
        \Assert\that($rels)->notEmpty()->all()->string();
        \Assert\that($classes)->all()->string();

        $this->rels = $rels;
        $this->href = $href;
        $this->classes = $classes;
        $this->title = $title;
        $this->type = $type;
    }

    /**
     * @return string[]
     */
    public function getRels() : array
    {
        return $this->rels;
    }

    public function hasRel(string $rel) : bool
    {
        return in_array($rel, $this->rels);
    }

    /**
     * @return string[]
     */
    public function getClasses() : array
    {
        return $this->classes;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getType() : string
    {
        return $this->type;
    }
}
