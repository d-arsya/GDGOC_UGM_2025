<?php

namespace App\Http\Controllers\Api\Docs\Schemas;

/**
 * @OA\Schema(
 *   schema="BookResource",
 *   type="object",
 *   @OA\Property(property="id", type="integer"),
 *   @OA\Property(property="title", type="string"),
 *   @OA\Property(property="author", type="string"),
 *   @OA\Property(property="published_at", type="date", format="date"),
 *   @OA\Property(property="created_at", type="date", format="date"),
 *   @OA\Property(property="updated_at", type="date", format="date"),
 * )
 * @OA\Schema(
 *   schema="BookUpdated",
 *   type="object",
 *   @OA\Property(property="data", type="object",ref="#/components/schemas/BookResource"),
 *   @OA\Property(property="original", type="object",ref="#/components/schemas/BookResource"),
 * )
 * @OA\Schema(
 *   schema="BookShow",
 *   type="object",
 *   @OA\Property(property="id", type="integer"),
 *   @OA\Property(property="success", type="boolean"),
 *   @OA\Property(
*         property="data",
*         type="array",
*         @OA\Items(ref="#/components/schemas/BookResource")
*       )
 * )
 * @OA\Schema(
 *   schema="BookCreated",
 *   type="object",
 *   @OA\Property(property="title", type="string"),
 *   @OA\Property(property="author", type="string"),
 *   @OA\Property(property="published_at", type="date", format="date"),
 *   @OA\Property(property="created_at", type="date", format="date"),
 *   @OA\Property(property="updated_at", type="date", format="date"),
 *   @OA\Property(property="id", type="integer"),
 * )
 * @OA\Schema(
 *     schema="BookUpdate",
 *   type="object",
 *   @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="title", type="string"),
 *   @OA\Property(property="author", type="string"),
 *   @OA\Property(property="published_at", type="date", format="date"),
 * )
 * @OA\Schema(
 *   schema="BookStore",
 *   type="object",
 *   @OA\Property(property="title", type="string"),
 *   @OA\Property(property="author", type="string"),
 *   @OA\Property(property="published_at", type="date", format="date"),
 * )
 *
 * @OA\Schema(
 *   schema="PagePagination",
 *   type="object",
 *   @OA\Property(property="current_page", type="integer"),
 *   @OA\Property(property="total_pages", type="integer"),
 *   @OA\Property(property="per_page", type="integer"),
 *   @OA\Property(property="total_items", type="integer"),
 * )
 *
 * @OA\Schema(
 *   schema="PageLinks",
 *   type="object",
 *   @OA\Property(property="next", type="string", format="url"),
 *   @OA\Property(property="prev", type="string", format="url")
 * )
 */
class BookSchema{}
