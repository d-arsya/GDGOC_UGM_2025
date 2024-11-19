<?php
 
 namespace App\Http\Controllers;

 use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
 use Illuminate\Foundation\Bus\DispatchesJobs;
 use Illuminate\Foundation\Validation\ValidatesRequests;
 use Illuminate\Routing\Controller as BaseController;

 /**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Dokumentasi API",
 *      description="Dokumentasi API sebagai penugasan Hacker Backend GDGoC UGM 2025",
 *      @OA\Contact(
 *          email="kamaluddin.arsyad17@gmail.com"
 *      ),
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Dokumentasi API sebagai penugasan Hacker Backend GDGoC UGM 2025"
 * )
 */
 class Controller extends BaseController
 {
     use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 }
