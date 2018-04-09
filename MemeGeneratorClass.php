<?php
class MemeGenerator {
    private $upperText;
    private $lowerText;
    private $alignment;
    private $background;
    private $border;
    private $font = 'assets/fonts/impact.ttf';
    private $im;
    private $imgSize;

    public function setUpperText($txt)
    {
        $this->upperText = strtoupper($txt);
    }

    public function setLowerText($txt)
    {
        $this->lowerText = strtoupper($txt);
    }


    private function getHorizontalTextAlignment($imgWidth, $topRightPixelOfText)
    {
        return ceil(($imgWidth - $topRightPixelOfText) / 2);
    }

    private function CheckTextWidthExceedImage($imgWidth, $fontWidth)
    {

        if ($imgWidth < $fontWidth + 20)
            return true;
        else
            return false;
    }

    private function GetFontPlacementCoordinates($text, $fontSize)
    {

        /*		returns
        *		Array
        *		(
        *			[0] => ? // lower left X coordinate
        *			[1] => ? // lower left Y coordinate
        *			[2] => ? // lower right X coordinate
        *			[3] => ? // lower right Y coordinate
        *			[4] => ? // upper right X coordinate
        *			[5] => ? // upper right Y coordinate
        *			[6] => ? // upper left X coordinate
        *			[7] => ? // upper left Y coordinate
        *		)
        **/

        return imagettfbbox($fontSize, 0, $this->font, $text);
    }

    private function ReturnImageFromPath($path)
    {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext == 'jpg' || $ext == 'jpeg')
            return imagecreatefromjpeg($path);
        else if ($ext == 'png')
            return imagecreatefrompng($path);
        else if ($ext == 'gif')
            return imagecreatefromgif($path);
    }

    public function __construct($path)
    {
        $this->im = $this->ReturnImageFromPath($path);
        $this->imgSize = getimagesize($path);
        $this->background = imagecolorallocate($this->im, 255, 255, 255);
        $this->border = imagecolorallocate($this->im, 0, 0, 0);
        imagecolortransparent($this->im, $this->background);
    }

    private function WorkOnImage($text, $size, $type)
    {
        if ($type == "upper")
            $TextHeight = 50;
        else
            $TextHeight = $this->imgSize[1] - 15;

        while (1)
        {
            //get coordinate for the text
            $coords = $this->GetFontPlacementCoordinates($text, $size);

            // place the text in center
            if ($type == "upper")
                $UpperTextX = $this->getHorizontalTextAlignment($this->imgSize[0], $coords[4]);
            else
                $LowerTextX = $this->getHorizontalTextAlignment($this->imgSize[0], $coords[4]);


            //check if the text does not exceed image width if yes then repeat with size = size - 1
            if ($this->CheckTextWidthExceedImage($this->imgSize[0], $coords[2] - $coords[0]))
            {
                if ($type == "upper")
                    $TextHeight = $TextHeight - 1;        //if it is top text take it up as font size decreases
                else
                    $TextHeight = $TextHeight + 1;        //if it is bottom text take it down as font size decreases

                if ($size == 10)
                {
                    //if text size is reached to lower limit and still it is exceeding image width start breaking into lines
                    if ($type == "upper")
                    {
                        $this->upperText = $this->ReturnMultipleLinesText($text, $type, 16);
                        $text = $this->upperText;

                        return;
                    } else
                    {
                        $this->lowerText = $this->ReturnMultipleLinesText($text, $type, $this->imgSize[1] - 20);
                        $text = $this->lowerText;

                        return;
                    }
                } else
                    $size -= 1;

            } else
                break;
        }

        if ($type == "upper")
            $this->PlaceTextOnImage($this->im, $size, 0, $UpperTextX, $TextHeight, $this->background, $this->border, $this->font, $this->upperText, 2);
        else
            $this->PlaceTextOnImage($this->im, $size, 0, $LowerTextX, $TextHeight, $this->background, $this->border, $this->font, $this->lowerText, 2);
    }

    private function PlaceTextOnImage($im, $fontsize, $angle, $Xlocation, $Textheight, $background, $strokecolor, $font, $text, $px)
    {
        for ($c1 = ($Xlocation - abs($px)); $c1 <= ($Xlocation + abs($px)); $c1++)
            for ($c2 = ($Textheight - abs($px)); $c2 <= ($Textheight + abs($px)); $c2++)
                $bg = imagettftext($im, $fontsize, $angle, $c1, $c2, $strokecolor, $font, $text);
        imagettftext($this->im, $fontsize, 0, $Xlocation, $Textheight, $this->background, $font, $text);
    }

    private function ReturnMultipleLinesText($text, $type, $textHeight)
    {
        //breaks the whole sentence into multiple lines according to the width of the image.


        //break sentence into an array of words by using the spaces as params
        $brokenText = explode(" ", $text);
        $finalOutput = "";

        if ($type != "upper")
            $textHeight = $this->imgSize[1] - ((count($brokenText) / 2) * 3);

        for ($i = 0; $i < count($brokenText); $i++)
        {
            $temp = $finalOutput;
            $finalOutput .= $brokenText[$i] . " ";
            // this will help us to keep the last word in hand if this word is the cause of text exceeding the image size.
            // We will be using this to append in next line.

            //check if word is too long i.e wider than image width

            //get the sentence(appended till now) placement coordinates
            $dimensions = $this->GetFontPlacementCoordinates($finalOutput, 10);

            //check if the sentence (till now) is exceeding the image with new word appended
            if ($this->CheckTextWidthExceedImage($this->imgSize[0], $dimensions[2] - $dimensions[0]))    //yes it is then
            {
                // append the previous sentence not with the new word  ( new word == $brokenText[$i] )
                $dimensions = $this->GetFontPlacementCoordinates($temp, 10);
                $locx = $this->getHorizontalTextAlignment($this->imgSize[0], $dimensions[4]);
                $this->PlaceTextOnImage($this->im, 10, $locx, $textHeight, $this->font, $temp, 2);
                $finalOutput = $brokenText[$i];
                $textHeight += 13;
            }

            //if this is the last word append this also.The previous if will be true if the last word will have no room
            if ($i == count($brokenText) - 1)
            {
                $dimensions = $this->GetFontPlacementCoordinates($finalOutput, 10);
                $locx = $this->getHorizontalTextAlignment($this->imgSize[0], $dimensions[4]);
                $this->PlaceTextOnImage($this->im, 10, $locx, $textHeight, $this->font, $finalOutput, 2);
            }
        }

        return $finalOutput;
    }

    public function processImg($preview)
    {
        if ($this->lowerText != "")
        {
            $this->WorkOnImage($this->lowerText, 30, "lower");
        }

        if ($this->upperText != "")
        {
            $this->WorkOnImage($this->upperText, 30, "upper");
        }
        if ($preview)
        {
            // Set the content type header - in this case image/jpeg
            header('Content-Type: image/jpeg');
            imagejpeg($this->im, null, 100);
            imagedestroy($this->im);
        } else
        {
        $id = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    	$imageid = str_shuffle($id);
    	$imageid = substr($imageid,0,10);
        include "config.php";
        // saving into the database
	$statement = $pdo->prepare("INSERT INTO mokomeme_memes (memes_title, memes_ext) VALUES (?,?)");
	$statement->execute(array($imageid,"jpg"));
	//$last_id = $pdo->lastInsertId();
            imagejpeg($this->im, 'assets/memes/'.$imageid.'.jpg');
            imagedestroy($this->im);
            return $imageid;
        }
    }
}
putenv('GDFONTPATH=' . realpath('.'));
?>