<?php
declare(strict_types=1);

namespace SwaggerBake\Lib\Annotation;

/**
 * Class level annotation for customizing Schema Attributes.
 *
 * Use this in your Entity classes (i.e. App\Model\Entity)
 *
 * @Annotation
 * @Target({"CLASS"})
 * @Attributes({
 * @Attribute("name", type = "string"),
 * @Attribute("type",  type = "string"),
 * @Attribute("format",  type = "string"),
 * @Attribute("description",  type = "string"),
 * @Attribute("readOnly",  type = "bool"),
 * @Attribute("writeOnly",  type = "bool"),
 * @Attribute("required",  type = "bool"),
 * @Attribute("multipleOf", type = "float"),
 * @Attribute("maximum",  type = "float"),
 * @Attribute("exclusiveMaximum",  type = "bool"),
 * @Attribute("minimum",  type = "float"),
 * @Attribute("exclusiveMinimum",  type = "bool"),
 * @Attribute("maxLength",  type = "integer"),
 * @Attribute("minLength", type = "integer"),
 * @Attribute("pattern",  type = "string"),
 * @Attribute("maxItems",  type = "integer"),
 * @Attribute("minItems",  type = "integer"),
 * @Attribute("uniqueItems",  type = "bool"),
 * @Attribute("maxProperties",  type = "integer"),
 * @Attribute("minProperties", type = "integer"),
 * @Attribute("enum", type = "array"),
 * })
 *
 * Example: Define an Entity property as required with a description, min and max length and regex:
 *
 * `@Swag\SwagEntityAttribute(refEntity="property_name", type="string", minLength=5, maxLength=10)`
 *
 * ```yaml
 *         property_name:
 *           type: string
 *           minLength: 5
 *           maxLength: 10
 * ```
 *
 * Example: Create enumerated list that is required
 *
 * `@Swag\SwagEntityAttribute(refEntity="property_name", type="string", enum={"PG","R"}, required=true)`
 *
 * ```yaml
 *         property_name:
 *           type: string
 *           enum:
 *              - PG
 *              - R
 *           required: true
 * ```
 *
 * Read OpenAPI specification for exact usage of the attributes:
 * @see https://swagger.io/specification/ search for "Schema Object"
 * @see https://swagger.io/docs/specification/data-models/data-types search for "data formats"
 * @see AbstractSchemaProperty
 */
class SwagEntityAttribute extends AbstractSchemaProperty
{
}
