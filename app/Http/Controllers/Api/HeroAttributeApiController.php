<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Hero;
use App\Providers\UserProvider;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Nkf\Laravel\Classes\Exceptions\ServerError;
use Nkf\Laravel\Traits\ApiController;

class HeroAttributeApiController
{
    use ApiController;

    protected $userProvider;

    public function __construct(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function updateAttributeValue(int $heroId, int $attributeId, Request $request) : JsonResponse
    {
        /** @var Hero $hero */
        $hero = $this->userProvider->getUser()->heroes()->find($heroId);
        if ($hero === null)
            throw new ServerError(['hero_id' => ['invalid_value']]);

        if (Attribute::whereGameId($hero->game_id)->find($attributeId) === null)
            throw new ServerError(['attribute_id' => ['invalid_value']]);

        try
        {
            DB::beginTransaction();
            $attributeValue = AttributeValue::query()
                ->whereHeroId($heroId)
                ->whereAttributeId($attributeId)
                ->first();
            $attributeValue->value = $request->only('value')['value'];
            $attributeValue->save();
            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollBack();
            throw new ServerError(['attribute_value' => ['no_update']]);
        }

        return $this->respondContent(['message' => 'Update attribute value']);
    }
}
