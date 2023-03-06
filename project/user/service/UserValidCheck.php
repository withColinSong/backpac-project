<?php

/**
 * @WRITE : yj.song
 * 유효성 검사
 * error code : -1000 ~ -1007
 */
class UserValidCheck {
    static function nameValid($val) {
        $pattern = '/^[a-zA-Z가-힣]+$/';

        if(strlen($val) >= 20) {
            self::throwError('이름은 20자 이상 넘길 수 없습니다.', "-1000");
        } else if (!preg_match($pattern, $val)){
           self::throwError('한글, 영문 대소문자만 가능합니다.', "-1001");
        }

        return $val;
    }

    static function nicknameValid($val) {
        $pattern = '/^[a-z]+$/';

        if(strlen($val) >= 30) {
            self::throwError('별명은 30자 이상 넘길 수 없습니다.', "-1002");
        } else if (!preg_match($pattern, $val)){
            self::throwError('영문 소문자만 가능합니다.', "-1003");
        }

        return $val;
    }


    // 영문 대문자, 영문 소문자, 특수문자, 숫자 1개 이상 포함
    static function passwordValid($val) {

        $patternNum = '/[0-9]+/';
        $patternUpperEng = '/[A-Z]+/';
        $patternLowerEng = '/[a-z]+/';
        $patternSpc = '/[~!@#$%^&*()_+|<>?:{}]/';

        if(strlen($val) <= 10) {
            self::throwError('비밀번호는 최소 10자 이상되어야 합니다.', "-1004");
        } else if (!(preg_match($patternNum, $val)
                    && preg_match($patternUpperEng, $val)
                    && preg_match($patternLowerEng, $val)
                    && preg_match($patternSpc, $val))
        ) {
            self::throwError('영문 대문자, 영문 소문자, 특수 문자, 숫자 각 1개 이상씩 포함해야 합니다.', "-1005");
        }

        return $val;
    }

    static function phoneValid($val) {

        $pattern = '/^01([0|1|6|7|8|9])-?([0-9]{3,4})-?([0-9]{4})$/';
        if(!preg_match($pattern, $val)) {
            self::throwError('전화번호 형식이 올바르지 않습니다.', "-1006");
        }
        return $val;
    }

    static function emailValid($val) {

        $pattern = '/^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/';
        if(!preg_match($pattern, $val)) {
            self::throwError('이메일 형식이 올바르지 않습니다.', "-1007");
        }
        return $val;
    }

    static function throwError($error = 'Error In Processing', $errorCode = 0) {
        throw new Exception($error, $errorCode);
    }



}