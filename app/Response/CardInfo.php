<?php

namespace App\Response;

class CardInfo
{

    /**
     * @var string Bin
     */
    protected $bin;

    /**
     * @var string|null Bank name
     */
    protected $bank;

    /**
     * @var string|null Cart scheme
     */
    protected $scheme;

    /**
     * @var string|null Card type
     */
    protected $type;

    /**
     * @var string Country name
     */
    protected $countryName;

    /**
     * @var string Country code
     */
    protected $countryCode;

    /**
     * Get bin
     *
     * @return string
     */
    public function getBin(): string
    {
        return $this->bin;
    }

    /**
     * Set bin
     *
     * @param string $bin
     * @return $this
     */
    public function setBin(string $bin): self
    {
        $this->bin = $bin;
        return $this;
    }

    /**
     * Get bank name
     *
     * @return string|null
     */
    public function getBank(): ?string
    {
        return $this->bank;
    }

    /**
     * Set bank name
     *
     * @param string|null $bank
     * @return $this
     */
    public function setBank(?string $bank): self
    {
        $this->bank = $bank;
        return $this;
    }

    /**
     * Get scheme
     *
     * @return string|null
     */
    public function getScheme(): ?string
    {
        return $this->scheme;
    }

    /**
     * Set card scheme visa, MC, etc.
     *
     * @param string|null $scheme
     * @return $this
     */
    public function setScheme(?string $scheme): self
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * Get type
     *
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Set type credit, debit
     *
     * @param string|null $type
     * @return $this
     */
    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get country name
     *
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->countryName;
    }

    /**
     * Set country name
     *
     * @param string $countryName
     * @return $this
     */
    public function setCountryName(string $countryName): self
    {
        $this->countryName = $countryName;
        return $this;
    }

    /**
     * Get country code
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * Set county code
     *
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }
}