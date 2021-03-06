<?php

class Emagedev_Yanws_Model_ArticleUtils_DOMWordsIterator
    extends Emagedev_Yanws_Model_ArticleUtils_DOMLettersIterator
{
    /**
     * Returns position in text as DOMText node and character offset.
     * (it's NOT a byte offset, you must use mb_substr() or similar to use this offset properly).
     * node may be NULL if iterator has finished.
     *
     * @return array
     */
    public function currentPosition()
    {
        return array($this->current, $this->offset, $this->parts);
    }

    public function next()
    {
        if (!$this->current) {
            return;
        }

        if ($this->current->nodeType == XML_TEXT_NODE || $this->current->nodeType == XML_CDATA_SECTION_NODE) {
            if ($this->offset == -1) {
                $this->parts = preg_split("/[\n\r\t ]+/", $this->current->textContent, -1,
                    PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE);
            }
            $this->offset++;

            if ($this->offset < count($this->parts)) {
                $this->key++;
                return;
            }
            $this->offset = -1;
        }

        $this->goNext();
    }

    public function current()
    {
        if ($this->current) {
            return $this->parts[$this->offset][0];
        }
        return null;
    }
}
