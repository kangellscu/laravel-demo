<?php

namespace App\Exceptions;

/**
 * Global exception code definitions
 */
final class ExceptionCode
{
    /********* General error ***********
     * General error code include:
     *      arguments format error
     *      arguments missing error
     *      user authorized error
     *      user authentication error
     *      and so on
     * Genral code count from 10000
     */

    /**
     * Code for general exception.
     *
     * @var int
     */
    const GENERAL = 10000;

    //=================
    //      Argument 
    //=================
    /**
     * Code for normal arugment error, include:
     *      required. eg. argument must be required, but missed
     *      format. eg. int be exception, but string be supplied
     */
    const ARGUMENT_FORMAT = 10001;

    //=================
    //      User
    //=================
    /**
     * Code for unauthentication exception. When a user not
     *      pass authentication check, this code will be return
     *
     * @var int
     */
    const USER_UNAUTH = 10101;

    /**
     * Code for unauthorized exception. When a user has not
     *      privilege to access a function, this code will
     *      be return
     *
     * @var int
     */
     const USER_UNAUTHORIZED = 10102;

     /**
      * Code for operation password unmatched
      *
      * @var int
      */
    const USER_OPERATION_PASSWORD_UNMATCH = 10103;

    /**
     * Code for user aready exists
     *
     * @var int
     */
    const USER_EXISTS = 10104;

    /**
     * Code for user not exists
     *
     * @var int
     */
    const USER_NOT_EXISTS = 10105;

    //============================
    //          HTTPRequest
    //============================
    /**
     * Code for bad response
     *
     * @var int
     */
    const HTTP_REQUEST_BAD_RESPONSE = 10301;

    /*********** Internal error *************
    // Internal error code include:
     *      network error
     *      third party api error 
     *      database error
     *      and so on
     * Internal error code count from 20000 
     */
}
