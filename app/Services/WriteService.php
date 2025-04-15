<?php

namespace App\Services;

use App\Http\Responses\JsonResponse;
use App\Models\Support\Trashable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;

/**
 * This service is a wrapper around the creation, update and deletion of models.
 * It encapsulates the validation and the creation logic.
 * 
 * More complex operations should be handled by the controller.
 * Think of this service as a shorcut to repetitive and generic code.
 * 
 * Make a deep think if this service suits the needs of the controller.
 * If you see the same code over and over, use this, may be useful.

 * @package App\Services
 */
class WriteService
{
    public function create($model, Validator $validator, $data, $message, $details=null)
    {
        if ($validator->fails()) {
            return JsonResponse::badRequest(__("messages.errors.form_rejected"), $validator->errors()->all());
        }

        /** @var Model $instance */
        $instance = new $model;

        $model = $instance::create($data);

        return JsonResponse::ok($message, $details);
    }

    public function update($model, $target_id, $validator, $data, $message, $details = null)
    {
        if ($validator->fails()) {
            return JsonResponse::badRequest(__("messages.errors.form_rejected"), $validator->errors()->all());
        }
        /** @var Model $instance */
        $instance = new $model;
        $target = $instance::find($target_id);

        if (!$target) {
            return JsonResponse::notFound("Record not found");
        }

        $target->update($data);
        return JsonResponse::ok($message, $details);
    }

    public function trash($model, $target_id, $message, $details=null)
    {
        /** @var Model $instance */
        $instance = new $model;
        $target = $instance::find($target_id);

        if (!$target) {
            return JsonResponse::notFound(__("messages.errors.record_not_found"));
        }

        if (!in_array(Trashable::class, class_uses($instance))) {
            return JsonResponse::badRequest(__("messages.errors.form_rejected"));
        }
        $target->trash();
        return JsonResponse::ok($message, $details);
    }

    public function recover($model, $target_id, $message, $details=null)
    {
        /** @var Model $instance */
        $instance = new $model;
        $target = $instance::find($target_id);

        if (!$target) {
            return JsonResponse::notFound(__("messages.errors.record_not_found"));
        }

        if (!in_array(Trashable::class, class_uses($instance))) {
            return JsonResponse::badRequest(__("messages.errors.model_not_trashable"));
        }
        $target->recover();
        return JsonResponse::ok($message, $details);
    }

    public function delete($model, $target_id, $message, $details=null)
    {
        /** @var Model $instance */
        $instance = new $model;
        $target = $instance::find($target_id);

        if (!$target) {
            return JsonResponse::notFound(__("messages.errors.record_not_found"));
        }
        $target->delete();
        return JsonResponse::ok($message, $details);
    }
}
