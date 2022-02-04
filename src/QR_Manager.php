<?php

namespace Decorate;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QR_Manager {

    private $_source;
    private $_size = 100;
    private $_format = 'svg';

    /**
     * QR_Manager constructor.
     * @param Model|string|null $source
     */
    public function __construct($source = null) {
        $this->_source = $source;
    }

    /**
     * @param Model|string $source
     * @return $this
     */
    public function source($source) {
        $this->_source = $source;
        return $this;
    }

    public function size(int $size) {
        $this->_size = $size;
        return $this;
    }

    public function format(string $format) {
        $this->_format = $format;
        return $this;
    }

    public function show() {
        $this->throwValidate();

        if($this->_source instanceof Model) {
            return QrCode::format($this->_format)
                ->size($this->_size)
                ->generate($this->_source->toJson());
        } else {
            return QrCode::format($this->_format)
                ->size($this->_size)
                ->generate($this->_source);
        }
    }

    public function download($name = 'qrcode') {
        $this->throwValidate();

        $code = $this->show();
        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $name .'.'. $this->_format .'"',
        ];
        return response($code, 200, $headers);
    }

    public function toBase64() {
        return base64_encode($this->show());
    }

    private function throwValidate() {
        if(!$this->_source) {
            throw new \Exception('Please call the method source to set the source');
        }
    }
}
