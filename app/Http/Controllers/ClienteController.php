<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
/**
* @OA\Info(
*             title="Api Crud", 
*             version="1.0",
*             description="Crud Clientes"
* )
*
* @OA\Server(url="http://127.0.0.1:8000")
*/

class ClienteController extends Controller
{
    /**
     * Título que define lo que hará esta URI
     * @OA\Get (
     *     path="/api/clientes",
     *     tags={"Cliente"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nombre",
     *                         type="string",
     *                         example="Samuel Contreras"
     *                     ),
     *                     @OA\Property(
     *                         property="correo",
     *                         type="string",
     *                         example="samuel@gmail.com"
     *                     ),
     *                      @OA\Property(
     *                         property="telefono",
     *                         type="string",
     *                         example="123456789"
     *                      ),
     *                      @OA\Property(
     *                         property="direccion",
     *                         type="string",
     *                         example="Madrid"
     *                      ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Cliente::all();
    }

    /**
     * Registrar la información de un Cliente
     * @OA\Post (
     *     path="/api/clientes",
     *     tags={"Cliente"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="nombre",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="correo",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="telefono",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="direccion",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "nombre":"",
     *                     "correo":"",
     *                     "telefono":"",
     *                     "direccion":""
     * 
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="CREATED",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="nombre", type="string", example="Daniel lopez"),
     *              @OA\Property(property="correo", type="string", example="daniel@gmail.com"),
     *              @OA\Property(property="telefono", type="string", example="123456789"),
     *              @OA\Property(property="direccion", type="string", example="Alicante"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="UNPROCESSABLE CONTENT",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The apellidos field is required."),
     *              @OA\Property(property="errors", type="string", example="Objeto de errores"),
     *          )
     *      )
     * )
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required',
            'telefono' => 'required',
            'direccion' => 'required'

        ]);
        $cliente = new Cliente;
        $cliente->nombre = $request->nombre;
        $cliente->correo= $request->correo;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        return $cliente;
    }

    /**
     * Mostrar la información de un cliente
     * @OA\Get (
     *     path="/api/clientes/{id}",
     *     tags={"Cliente"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=2),
     *              @OA\Property(property="nombre", type="string", example="Enrique Contreras"),
     *              @OA\Property(property="correo", type="string", example="enrique@gmail.com"),
     *              @OA\Property(property="telefono", type="string", example="321654987"),
     *              @OA\Property(property="dirteccion", type="string", example="Barcelona"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NO SE ENCUENTRA EL REGISTRO",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Cliente] #id"),
     *          )
     *      )
     * )
     */

    public function show(Cliente $cliente)
    {
        return $cliente;
    }

    /**
 * Actualizar la información de un Cliente
 * @OA\Put (
 *     path="/api/clientes/{id}",
 *     tags={"Cliente"},
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(
 *                     property="nombre",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="correo",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="telefono",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="direccion",
 *                     type="string"
 *                 )
 *             ),
 *             example={
 *                 "nombre": "",
 *                 "correo": "",
 *                 "telefono": "",
 *                 "direccion": ""
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="success",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="number", example=1),
 *             @OA\Property(property="nombre", type="string", example="Daniel lopez edit"),
 *             @OA\Property(property="correo", type="string", example="daniel@gmail.es"),
 *             @OA\Property(property="telefono", type="string", example="123456788"),
 *             @OA\Property(property="direccion", type="string", example="Alicante edit"),
 *             @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
 *             @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="UNPROCESSABLE CONTENT",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The apellidos field is required."),
 *             @OA\Property(property="errors", type="string", example="Objeto de errores"),
 *         )
 *     )
 * )
 */


    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required',
            'telefono' => 'required',
            'direccion' => 'required'

        ]);
        $cliente->nombre = $request->nombre;
        $cliente->correo= $request->correo;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->update();

        return $cliente;
    }

    /**
 * Eliminar la información de un cliente
 * @OA\Delete (
 *     path="/api/clientes/{id}",
 *     tags={"Cliente"},
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Operación exitosa. No hay contenido (NO CONTENT)."
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="El cliente no fue encontrado (NOT FOUND).",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No se encontró el cliente con el ID especificado."),
 *         )
 *     )
 * )
 */


    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if(is_null($cliente))
        {
            return response()->json('No se pudo realizar la operación', 404);
        }
        $cliente->delete();
        return response()->noContent();
    }
}
