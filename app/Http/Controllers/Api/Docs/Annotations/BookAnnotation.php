<?php

namespace App\Http\Controllers\Api\Docs\Annotations;
abstract class BookAnnotation{
    // <<<<<<=======INDEX FUNCTION=======>>>>>>
    
    /**
     * @OA\Get(
     *   tags={"Book"},
     *   path="/books",
     *   summary="Get all books data",
     *  @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Page number for pagination.",
     *     required=false,
     *     @OA\Schema(type="integer", example=1)
     *   ),
     *   @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     description="Number of items per page.",
     *     required=false,
     *     @OA\Schema(type="integer", example=5)
     *   ),
     *   @OA\Parameter(
     *     name="order",
     *     in="query",
     *     description="Order of sorting.",
     *     required=false,
     *     @OA\Schema(type="string", enum={"asc", "desc"}, example="asc")
     *   ),
     *   @OA\Parameter(
     *     name="sort",
     *     in="query",
     *     description="Field to sort",
     *     required=false,
     *     @OA\Schema(type="string", enum={"title", "author","published_at"},example="id")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/BookResource")
     *       ),
     *       @OA\Property(property="pagination", ref="#/components/schemas/PagePagination"),
     *       @OA\Property(property="links", ref="#/components/schemas/PageLinks")
     *     )
     *   )
     * )
     */
    function index(){}
    
    // <<<<<<=======STORE FUNCTION=======>>>>>>
    
    /**
     * @OA\Post(
     *       tags={"Book"},
     *         path="/books",
     *         summary="Create single book data",
     *         @OA\RequestBody(
     *           required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"xxx"},
     *       ref="#/components/schemas/BookStore"
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string"),
     *       @OA\Property(property="data", ref="#/components/schemas/BookCreated"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Required input is null",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string")
     *     )
     *   )
     * )
     */
    
    function store(){}
    // <<<<<<=======STORE BULK FUNCTION=======>>>>>>
    
    /**
     * @OA\Post(
     *     tags={"Book"},
     *     path="/books/bulk",
     *     summary="Create bulk books data",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(
     *           type="object",
     *           ref="#/components/schemas/BookStore"
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Books created successfully",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *       ),
     *        @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(
     *           type="object",ref="#/components/schemas/BookCreated"
     *         )
     *       ),  
     *        @OA\Property(
     *         property="failed",
     *         type="array",
     *         @OA\Items(
     *           type="object",ref="#/components/schemas/BookStore"
     *         )
     *       )      
     *     )
     *   )
     * )
     */
    
    function storeBulk(){}
    // <<<<<<=======SHOW FUNCTION=======>>>>>>
    
    /**
     * @OA\Get(
     *     path="/books/{id}",
     *     summary="Get book by ID",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *     description="ID of the book to retrieve",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Book details",
     *     @OA\JsonContent(
     *       @OA\Property(property="data", ref="#/components/schemas/BookResource"),
     *     )
     *   ),
     *   @OA\Response(response=404, description="Book not found",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string"),
     *     )
     * )
     * )
     */
    function show(){}
    
    // <<<<<<=======SHOW BULK FUNCTION=======>>>>>>
    
    /**
     * @OA\Get(
     *     path="/books/bulk",
     *     summary="Get multiple books by IDs",
     *     tags={"Book"},
     *     @OA\Parameter(
     *     name="ids",
     *     in="query",
     *     required=true,
     *     description="Comma-separated list of book IDs",
     *     @OA\Schema(
     *       type="string",
     *       example="1,2,3"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Books retrieved successfully",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *       ),
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/BookShow"),
     *       )
     *     )
     *   ),
     *     @OA\Response(response=404, description="Query input is required",
     *      @OA\JsonContent(
     *       @OA\Property(property="message", type="string"),
     *     )
     * )
     * )
     */
    function showBulk(){}
    
    // <<<<<<=======UPDATE FUNCTION=======>>>>>>
    
    /**
     * @OA\Put(
     *     path="/books/{id}",
     *     summary="Update a book",
     *   tags={"Book"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="ID of the book to update",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *     required=false,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="title", type="string"),
     *       @OA\Property(property="author", type="string"),
     *       @OA\Property(property="published_date", type="string", format="date")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Book updated successfully",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="message", type="string"),
     *       @OA\Property(property="data", ref="#/components/schemas/BookUpdated")
     *     )
     *   ),
     *   @OA\Response(
     *     response=404, 
     *     description="Book not found",
     *      @OA\JsonContent(
     *        type="object",
     *         @OA\Property(property="message", type="string")
     *      )
     *   )
     *  )
     */
    function update(){}
    
    // <<<<<<=======UPDATE BULK FUNCTION=======>>>>>>
    
    /**
     * @OA\Put(
     *       path="/books/bulk",
     *         summary="Update multiple books",
     *         tags={"Book"},
     *       @OA\RequestBody(
     *         required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(
     *           type="object",
     *           ref="#/components/schemas/BookUpdate"
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Books updated successfully",
     *     @OA\JsonContent(
     *       type="object",
     *        @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(
     *           type="object",
     *           @OA\Property(property="id", type="integer"),
     *           @OA\Property(property="success", type="boolean"),
     *           @OA\Property(property="data", type="object",ref="#/components/schemas/BookResource"),
     *           @OA\Property(property="original", type="object",ref="#/components/schemas/BookResource"),
     *         )
     *               )      
     *     )
     *   )
     * )
     */
    function updateBulk(){}
    
    
    // <<<<<<=======DESTROY FUNCTION=======>>>>>>
    
    /**
     * @OA\Delete(
     *     path="/books/{id}",
     *     summary="Delete a book",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *     required=true,
     *     description="ID of the book to delete",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Book deleted successfully",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="message", type="string")
     *     )
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Book not found",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="message", type="string")
     *     )
     *   ),
     * )
     */
    function destroy(){}
    
    
    // <<<<<<=======DESTROY BULK FUNCTION=======>>>>>>
    
    /**
     * @OA\Delete(
     *     path="/books/bulk",
     *     summary="Delete multiple books",
     *     tags={"Book"},
     *    @OA\Parameter(
     *     name="ids",
     *     in="query",
     *     required=true,
     *     description="Comma-separated list of book IDs",
     *     @OA\Schema(
     *       type="string",
     *       example="1,2,3"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Books deleted successfully",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="message", type="string"),
     *       @OA\Property(property="data", type="array",
     *          @OA\Items(
     *            type="object",
     *            @OA\Property(
     *              property="id",
     *              type="integer"
     *            ),
     *            @OA\Property(
     *              property="success",
     *              type="boolean"
     *            ),
     *          )  
     *   )
     *     )
     *   ),
     *   @OA\Response(response=404, description="Query input is required")
     * )
     */
    function destroyBulk(){}
    
    // <<<<<<=======GENERATE FUNCTION=======>>>>>>
    
    /**
     * @OA\Get(
     *     tags={"Database"},
     *   path="/books/generate",
     *   summary="Generate dummy data",
     *  @OA\Parameter(
     *     name="count",
     *     in="query",
     *     required=true,
     *     description="Count of books to generate",
     *     @OA\Schema(
     *       type="integer",
     *       example="100"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Books created successfully",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *       ),
     *       @OA\Property(
     *         property="count",
     *         type="integer",
     *       ),
     *        @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(
     *           type="object",ref="#/components/schemas/BookCreated"
     *         )
     *       ),
     *     )
     *   )
     * )
     */
    function generate(){}
    
    // <<<<<<=======GET TOKEN FUNCTION=======>>>>>>
    
    /**
     * @OA\Get(
     *     path="/reset",
     *     summary="Generate a reset token",
     *     tags={"Database"},
     *     description="Generates a token that can be used to reset the database. The token expires after a specified time.",
     *   @OA\Response(
     *     response=200,
     *     description="Token generated successfully",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="message", type="string", example="Token generated successfully."),
     *       @OA\Property(property="token", type="string", example="b1a2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z"),
     *       @OA\Property(property="expired_at", type="string", example="2024-11-19 12:34:56 (20 seconds later)")
     *     )
     *   )
     * )
     */
    function getToken(){}
    
    // <<<<<<=======RESET DATABASE FUNCTION=======>>>>>>
    
    /**
     * @OA\Post(
     *     path="/reset",
     *     summary="Reset the database",
     *     tags={"Database"},
     *     description="Resets the database using a valid reset token.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"token"},
     *             @OA\Property(property="token", type="string", example="b1a2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z")
     *           )
     *       ),
     *     @OA\Response(
     *         response=200,
     *         description="Database reset successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Database has been reset successfully.")
     *           )
     *   ),
     *   @OA\Response(
     *     response=400,
     *     description="Bad Request",
     *     @OA\JsonContent(
     *       type="object",
     *       oneOf={
     *         @OA\Schema(
     *           @OA\Property(property="message", type="string", example="Invalid token.")
     *         ),
     *         @OA\Schema(
     *           @OA\Property(property="message", type="string", example="Token has expired.")
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response=500,
     *     description="Internal Server Error",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="message", type="string", example="Error resetting database."),
     *       @OA\Property(property="error", type="string", example="An unexpected error occurred.")
     *     )
     *   )
     * )
     */
    function resetDatabase(){}
}