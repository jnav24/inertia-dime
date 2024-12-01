<?php

namespace App\Services;

use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use PragmaRX\Google2FA\Google2FA;

class MfaService
{
    public function __construct(protected Google2FA $google2FA)
    {}

    /**
     * @return string
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     */
    public function generateSecretKey(): string
    {
        return $this->google2FA->generateSecretKey();
    }

    /**
     * @param string $secret
     * @param string $code
     * @return bool
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws InvalidCharactersException
     * @throws SecretKeyTooShortException
     */
    public function verify(string $secret, string $code): bool
    {
        return (bool) $this->google2FA->verifyKey($secret, $code);
    }

    public function generateQrCodeSvg(string $companyName, string $companyEmail, string $secretKey): string
    {
        $svg = (new Writer(
            new ImageRenderer(
                new RendererStyle(
                    192,
                    0,
                    null,
                    null,
                    Fill::uniformColor(
                        new Rgb(255, 255, 255),
                        new Rgb(45, 55, 72)
                    )
                ),
                new SvgImageBackEnd(),
            )
        ))->writeString(
            $this->qrCodeUrl($companyName, $companyEmail, $secretKey),
        );

        return trim(substr($svg, strpos($svg, "\n") + 1));
    }

    private function qrCodeUrl(string $companyName, string $companyEmail, string $secretKey): string
    {
        return $this->google2FA->getQRCodeUrl($companyName, $companyEmail, $secretKey);
    }
}
