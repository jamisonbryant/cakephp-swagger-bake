<?php
declare(strict_types=1);

namespace SwaggerBake\Lib\Annotation;

/**
 * @Annotation
 * @Target({"CLASS"})
 * @Attributes({
 * @Attribute("isVisible", type="bool"),
 * @Attribute("title", type="string"),
 * @Attribute("description", type="string"),
 * })
 */
class SwagEntity
{
    /**
     * @var bool
     **/
    public $isVisible;

    /**
     * @var string|null
     */
    public $title;

    /**
     * @var string|null
     */
    public $description;

    /**
     * @param array $values Annotation attributes as key-value pair
     */
    public function __construct(array $values)
    {
        foreach ($values as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }
}
