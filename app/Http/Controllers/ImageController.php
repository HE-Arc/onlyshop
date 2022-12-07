<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : linking the image model with the item's informations vue.

Wrote by : Miguel Moreira
updated by : Miguel Moreira
*/

class ImageController extends Controller
{
    /**
     * @api {post} /api/images Add new image to the database
     * @apiName store
     * @apiGroup Image
     *
     * @apiParam {Number} item_id The id of the item that the image is linked to.
     * @apiParam {File} image The image to add.
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|numeric|min:1',
            'image' => 'required|mimes:jpg, jpeg, png|max:2048',
        ]);

        $image = new Image();
        $image->item_id = $request->item_id;

        if ($request->hasFile('image')) {
            $image_name = $request->item_id.'_'.$request->file->getClientOriginalName();
            $image_path = $request->file('image')->storeAs('uploads', $image_name, 'public');

            $image->imagepath = '/storage/' . $image_path;
            $image->save();
            return response()->json(
                [
                    'message' => 'Image added successfully',
                    'status' => "success"
                ]
            );
        }
    }

    /**
     * @api {delete} /api/images/:id delete an image from the database
     * @apiName destroy
     * @apiGroup Image
     *
     * @apiParam {Number} id The id of the image to delete.
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();

        return response()->json(
            [
                'message' => 'Image deleted successfully',
                'status' => "success"
            ]
        );
    }

    /**
     * @api {get} /api/images/getItemImages/:id Get all the images of an item
     * @apiName getItemImages
     * @apiGroup Image
     *
     * @apiParam {Number} id The id of the item to get the images from.
     *
     * @apiSuccess {String} message The message of the request.
     * @apiSuccess {String} status The status of the request.
     * @apiSuccess {Array} images The images of the item.
     */
    public function getItemImages(Request $request)
    {
        $images = Image::where('item_id', $request->id)->get();
        return response()->json(
            [
                'message' => 'Images found successfully',
                'status' => "success",
                'images' => $images
            ]
        );
    }
}
