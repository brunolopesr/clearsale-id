<?php

namespace RodrigoPedra\ClearSaleID\Entity\Request;

use InvalidArgumentException;
use RodrigoPedra\ClearSaleID\Entity\XmlEntityInterface;
use RodrigoPedra\ClearSaleID\Exception\RequiredFieldException;
use XMLWriter;

class Item implements XmlEntityInterface
{
    /** @var  string */
    private $id;

    /** @var  string */
    private $name;

    /** @var  string */
    private $value;

    /** @var  string */
    private $quantity;

    /** @var  string */
    private $notes;

    /** @var  string */
    private $categoryId;

    /** @var  string */
    private $categoryName;

    /**
     * Criar Item com campos obrigatórios preenchidos
     *
     * @param  string  $id       Código do Produto
     * @param  string  $name     Nome do Produto
     * @param  float   $value    Valor Unitário
     * @param  integer $quantity Quantidade
     *
     * @return \RodrigoPedra\ClearSaleID\Entity\Request\Item
     */
    public static function create( $id, $name, $value, $quantity )
    {
        $instance = new self;

        $instance->setId( $id );
        $instance->setName( $name );
        $instance->setValue( $value );
        $instance->setQuantity( $quantity );

        return $instance;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  string $id
     *
     * @return $this
     */
    public function setId( $id )
    {
        if (empty( $id )) {
            throw new InvalidArgumentException( 'Id is empty!' );
        }

        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  string $name
     *
     * @return $this
     */
    public function setName( $name )
    {
        if (empty( $name )) {
            throw new InvalidArgumentException( 'Name is empty!' );
        }

        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param  string $value
     *
     * @return $this
     */
    public function setValue( $value )
    {
        if (!is_float( $value )) {
            throw new InvalidArgumentException( sprintf( 'Invalid value', $value ) );
        }

        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param  string $quantity
     *
     * @return $this
     */
    public function setQuantity( $quantity )
    {
        if (!is_int( $quantity )) {
            throw new InvalidArgumentException( sprintf( 'Invalid quantity', $quantity ) );
        }

        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param  string $notes
     *
     * @return $this
     */
    public function setNotes( $notes )
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param  string $categoryId
     *
     * @return $this
     */
    public function setCategoryId( $categoryId )
    {
        if (!is_int( $categoryId )) {
            throw new InvalidArgumentException( sprintf( 'Invalid categoryId', $categoryId ) );
        }

        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @param  string $categoryName
     *
     * @return $this
     */
    public function setCategoryName( $categoryName )
    {
        if (empty( $categoryName )) {
            throw new InvalidArgumentException( 'Category name is empty!' );
        }

        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * @param  \XMLWriter $XMLWriter
     *
     * @throws \RodrigoPedra\ClearSaleID\Exception\RequiredFieldException
     */
    public function toXML( XMLWriter $XMLWriter )
    {
        $XMLWriter->startElement( 'Item' );

        if ($this->id) {
            $XMLWriter->writeElement( 'CodigoItem', $this->id );
        } else {
            throw new RequiredFieldException( 'Field ID of the Item object is required' );
        }

        if ($this->name) {
            $XMLWriter->writeElement( 'NomeItem', $this->name );
        } else {
            throw new RequiredFieldException( 'Field Name of the Item object is required' );
        }

        if ($this->value) {
            $XMLWriter->writeElement( 'ValorItem', $this->value );
        } else {
            throw new RequiredFieldException( 'Field ItemValue of the Item object is required' );
        }

        if ($this->quantity) {
            $XMLWriter->writeElement( 'Quantidade', $this->quantity );
        } else {
            throw new RequiredFieldException( 'Field Quantity of the Item object is required' );
        }

        if ($this->notes) {
            $XMLWriter->writeElement( 'Generico', $this->notes );
        }

        if ($this->categoryId) {
            $XMLWriter->writeElement( 'CodigoCategoria', $this->categoryId );
        }

        if ($this->categoryName) {
            $XMLWriter->writeElement( 'NomeCategoria', $this->categoryName );
        }

        $XMLWriter->endElement();
    }
}
