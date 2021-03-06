<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Models\Hero;
use App\Models\StructuralAttributeValue;
use Nkf\General\Classes\BaseFormatter;
use Nkf\General\Utils\ArrayUtils;

class FullHeroApiFormatter extends BaseFormatter
{
    public function __construct(
        HeroCharacteristicApiFormatter $characteristicFormatter,
        HeroAttributeValueApiFormatter $attributeValueFormatter,
        StructuralAttributeFormatter $structuralAttributeFormatter
    )
    {
        $this->setFormatter(function (Hero $hero) use (
            $characteristicFormatter,
            $attributeValueFormatter,
            $structuralAttributeFormatter
        ) : array
        {
            $valuesByStructuralAttribute = [];
            foreach ($hero->structuralAttributeValues as $value)
                $valuesByStructuralAttribute[$value->attribute_id][] = $value;

            $structuralAttributes = [];
            foreach ($valuesByStructuralAttribute as $values)
            {
                /** @var StructuralAttributeValue $firstValue */
                $firstValue = ArrayUtils::first($values);
                $attribute = $firstValue->attribute;
                $structuralAttributes[] = $structuralAttributeFormatter->format($attribute, ['selectedValues' => $values]);
            }

            return [
                'id' => $hero->id,
                'name' => $hero->name,
                'note' => $hero->note,
                'game_id' => $hero->game_id,
                'characteristics' => $characteristicFormatter->formatList($hero->characteristicValues),
                'attributes' => $attributeValueFormatter->formatList($hero->attributeValues),
                'structural_attributes' => $structuralAttributes,
            ];
        });
    }
}
