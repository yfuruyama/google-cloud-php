<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/automl/v1/io.proto

namespace Google\Cloud\AutoMl\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Input configuration for
 * [AutoMl.ImportData][google.cloud.automl.v1.AutoMl.ImportData] action.
 * The format of input depends on dataset_metadata the Dataset into which
 * the import is happening has. As input source the
 * [gcs_source][google.cloud.automl.v1.InputConfig.gcs_source]
 * is expected, unless specified otherwise. Additionally any input .CSV file
 * by itself must be 100MB or smaller, unless specified otherwise.
 * If an "example" file (that is, image, video etc.) with identical content
 * (even if it had different `GCS_FILE_PATH`) is mentioned multiple times, then
 * its label, bounding boxes etc. are appended. The same file should be always
 * provided with the same `ML_USE` and `GCS_FILE_PATH`, if it is not, then
 * these values are nondeterministically selected from the given ones.
 * The formats are represented in EBNF with commas being literal and with
 * non-terminal symbols defined near the end of this comment. The formats are:
 * <h4>AutoML Vision</h4>
 * <div class="ds-selector-tabs"><section><h5>Classification</h5>
 * See [Preparing your training
 * data](https://cloud.google.com/vision/automl/docs/prepare) for more
 * information.
 * CSV file(s) with each line in format:
 *     ML_USE,GCS_FILE_PATH,LABEL,LABEL,...
 * *   `ML_USE` - Identifies the data set that the current row (file) applies
 * to.
 *     This value can be one of the following:
 *     * `TRAIN` - Rows in this file are used to train the model.
 *     * `TEST` - Rows in this file are used to test the model during training.
 *     * `UNASSIGNED` - Rows in this file are not categorized. They are
 *        Automatically divided into train and test data. 80% for training and
 *        20% for testing.
 * *   `GCS_FILE_PATH` - The Google Cloud Storage location of an image of up to
 *      30MB in size. Supported extensions: .JPEG, .GIF, .PNG, .WEBP, .BMP,
 *      .TIFF, .ICO.
 * *   `LABEL` - A label that identifies the object in the image.
 * For the `MULTICLASS` classification type, at most one `LABEL` is allowed
 * per image. If an image has not yet been labeled, then it should be
 * mentioned just once with no `LABEL`.
 * Some sample rows:
 *     TRAIN,gs://folder/image1.jpg,daisy
 *     TEST,gs://folder/image2.jpg,dandelion,tulip,rose
 *     UNASSIGNED,gs://folder/image3.jpg,daisy
 *     UNASSIGNED,gs://folder/image4.jpg
 * </section><section><h5>Object Detection</h5>
 * See [Preparing your training
 * data](https://cloud.google.com/vision/automl/object-detection/docs/prepare)
 * for more information.
 * A CSV file(s) with each line in format:
 *     ML_USE,GCS_FILE_PATH,[LABEL],(BOUNDING_BOX | ,,,,,,,)
 * *   `ML_USE` - Identifies the data set that the current row (file) applies
 * to.
 *     This value can be one of the following:
 *     * `TRAIN` - Rows in this file are used to train the model.
 *     * `TEST` - Rows in this file are used to test the model during training.
 *     * `UNASSIGNED` - Rows in this file are not categorized. They are
 *        Automatically divided into train and test data. 80% for training and
 *        20% for testing.
 * *  `GCS_FILE_PATH` - The Google Cloud Storage location of an image of up to
 *     30MB in size. Supported extensions: .JPEG, .GIF, .PNG. Each image
 *     is assumed to be exhaustively labeled.
 * *  `LABEL` - A label that identifies the object in the image specified by the
 *    `BOUNDING_BOX`.
 * *  `BOUNDING BOX` - The vertices of an object in the example image.
 *    The minimum allowed `BOUNDING_BOX` edge length is 0.01, and no more than
 *    500 `BOUNDING_BOX` instances per image are allowed (one `BOUNDING_BOX`
 *    per line). If an image has no looked for objects then it should be
 *    mentioned just once with no LABEL and the ",,,,,,," in place of the
 *   `BOUNDING_BOX`.
 * **Four sample rows:**
 *     TRAIN,gs://folder/image1.png,car,0.1,0.1,,,0.3,0.3,,
 *     TRAIN,gs://folder/image1.png,bike,.7,.6,,,.8,.9,,
 *     UNASSIGNED,gs://folder/im2.png,car,0.1,0.1,0.2,0.1,0.2,0.3,0.1,0.3
 *     TEST,gs://folder/im3.png,,,,,,,,,
 *   </section>
 * </div>
 * <h4>AutoML Natural Language</h4>
 * <div class="ds-selector-tabs"><section><h5>Entity Extraction</h5>
 * See [Preparing your training
 * data](/natural-language/automl/entity-analysis/docs/prepare) for more
 * information.
 * One or more CSV file(s) with each line in the following format:
 *     ML_USE,GCS_FILE_PATH
 * *   `ML_USE` - Identifies the data set that the current row (file) applies
 * to.
 *     This value can be one of the following:
 *     * `TRAIN` - Rows in this file are used to train the model.
 *     * `TEST` - Rows in this file are used to test the model during training.
 *     * `UNASSIGNED` - Rows in this file are not categorized. They are
 *        Automatically divided into train and test data. 80% for training and
 *        20% for testing..
 * *   `GCS_FILE_PATH` - a Identifies JSON Lines (.JSONL) file stored in
 *      Google Cloud Storage that contains in-line text in-line as documents
 *      for model training.
 * After the training data set has been determined from the `TRAIN` and
 * `UNASSIGNED` CSV files, the training data is divided into train and
 * validation data sets. 70% for training and 30% for validation.
 * For example:
 *     TRAIN,gs://folder/file1.jsonl
 *     VALIDATE,gs://folder/file2.jsonl
 *     TEST,gs://folder/file3.jsonl
 * **In-line JSONL files**
 * In-line .JSONL files contain, per line, a JSON document that wraps a
 * [`text_snippet`][google.cloud.automl.v1.TextSnippet] field followed by
 * one or more [`annotations`][google.cloud.automl.v1.AnnotationPayload]
 * fields, which have `display_name` and `text_extraction` fields to describe
 * the entity from the text snippet. Multiple JSON documents can be separated
 * using line breaks (\n).
 * The supplied text must be annotated exhaustively. For example, if you
 * include the text "horse", but do not label it as "animal",
 * then "horse" is assumed to not be an "animal".
 * Any given text snippet content must have 30,000 characters or
 * less, and also be UTF-8 NFC encoded. ASCII is accepted as it is
 * UTF-8 NFC encoded.
 * For example:
 *     {
 *       "text_snippet": {
 *         "content": "dog car cat"
 *       },
 *       "annotations": [
 *          {
 *            "display_name": "animal",
 *            "text_extraction": {
 *              "text_segment": {"start_offset": 0, "end_offset": 2}
 *           }
 *          },
 *          {
 *           "display_name": "vehicle",
 *            "text_extraction": {
 *              "text_segment": {"start_offset": 4, "end_offset": 6}
 *            }
 *          },
 *          {
 *            "display_name": "animal",
 *            "text_extraction": {
 *              "text_segment": {"start_offset": 8, "end_offset": 10}
 *            }
 *          }
 *      ]
 *     }\n
 *     {
 *        "text_snippet": {
 *          "content": "This dog is good."
 *        },
 *        "annotations": [
 *           {
 *             "display_name": "animal",
 *             "text_extraction": {
 *               "text_segment": {"start_offset": 5, "end_offset": 7}
 *             }
 *           }
 *        ]
 *     }
 * **JSONL files that reference documents**
 * .JSONL files contain, per line, a JSON document that wraps a
 * `input_config` that contains the path to a source PDF document.
 * Multiple JSON documents can be separated using line breaks (\n).
 * For example:
 *     {
 *       "document": {
 *         "input_config": {
 *           "gcs_source": { "input_uris": [ "gs://folder/document1.pdf" ]
 *           }
 *         }
 *       }
 *     }\n
 *     {
 *       "document": {
 *         "input_config": {
 *           "gcs_source": { "input_uris": [ "gs://folder/document2.pdf" ]
 *           }
 *         }
 *       }
 *     }
 * **In-line JSONL files with PDF layout information**
 * **Note:** You can only annotate PDF files using the UI. The format described
 * below applies to annotated PDF files exported using the UI or `exportData`.
 * In-line .JSONL files for PDF documents contain, per line, a JSON document
 * that wraps a `document` field that provides the textual content of the PDF
 * document and the layout information.
 * For example:
 *     {
 *       "document": {
 *               "document_text": {
 *                 "content": "dog car cat"
 *               }
 *               "layout": [
 *                 {
 *                   "text_segment": {
 *                     "start_offset": 0,
 *                     "end_offset": 11,
 *                    },
 *                    "page_number": 1,
 *                    "bounding_poly": {
 *                       "normalized_vertices": [
 *                         {"x": 0.1, "y": 0.1},
 *                         {"x": 0.1, "y": 0.3},
 *                         {"x": 0.3, "y": 0.3},
 *                         {"x": 0.3, "y": 0.1},
 *                       ],
 *                     },
 *                     "text_segment_type": TOKEN,
 *                 }
 *               ],
 *               "document_dimensions": {
 *                 "width": 8.27,
 *                 "height": 11.69,
 *                 "unit": INCH,
 *               }
 *               "page_count": 3,
 *             },
 *             "annotations": [
 *               {
 *                 "display_name": "animal",
 *                 "text_extraction": {
 *                   "text_segment": {"start_offset": 0, "end_offset": 3}
 *                 }
 *               },
 *               {
 *                 "display_name": "vehicle",
 *                 "text_extraction": {
 *                   "text_segment": {"start_offset": 4, "end_offset": 7}
 *                 }
 *               },
 *               {
 *                 "display_name": "animal",
 *                 "text_extraction": {
 *                   "text_segment": {"start_offset": 8, "end_offset": 11}
 *                 }
 *               },
 *             ],
 * </section><section><h5>Classification</h5>
 * See [Preparing your training
 * data](https://cloud.google.com/natural-language/automl/docs/prepare) for more
 * information.
 * One or more CSV file(s) with each line in the following format:
 *     ML_USE,(TEXT_SNIPPET | GCS_FILE_PATH),LABEL,LABEL,...
 * *   `ML_USE` - Identifies the data set that the current row (file) applies
 * to.
 *     This value can be one of the following:
 *     * `TRAIN` - Rows in this file are used to train the model.
 *     * `TEST` - Rows in this file are used to test the model during training.
 *     * `UNASSIGNED` - Rows in this file are not categorized. They are
 *        Automatically divided into train and test data. 80% for training and
 *        20% for testing.
 * *   `TEXT_SNIPPET` and `GCS_FILE_PATH` are distinguished by a pattern. If
 *     the column content is a valid Google Cloud Storage file path, that is,
 *     prefixed by "gs://", it is treated as a `GCS_FILE_PATH`. Otherwise, if
 *     the content is enclosed in double quotes (""), it is treated as a
 *     `TEXT_SNIPPET`. For `GCS_FILE_PATH`, the path must lead to a
 *     file with supported extension and UTF-8 encoding, for example,
 *     "gs://folder/content.txt" AutoML imports the file content
 *     as a text snippet. For `TEXT_SNIPPET`, AutoML imports the column content
 *     excluding quotes. In both cases, size of the content must be 10MB or
 *     less in size. For zip files, the size of each file inside the zip must be
 *     10MB or less in size.
 *     For the `MULTICLASS` classification type, at most one `LABEL` is allowed.
 *     The `ML_USE` and `LABEL` columns are optional.
 *     Supported file extensions: .TXT, .PDF, .ZIP
 * A maximum of 100 unique labels are allowed per CSV row.
 * Sample rows:
 *     TRAIN,"They have bad food and very rude",RudeService,BadFood
 *     gs://folder/content.txt,SlowService
 *     TEST,gs://folder/document.pdf
 *     VALIDATE,gs://folder/text_files.zip,BadFood
 * </section><section><h5>Sentiment Analysis</h5>
 * See [Preparing your training
 * data](https://cloud.google.com/natural-language/automl/docs/prepare) for more
 * information.
 * CSV file(s) with each line in format:
 *     ML_USE,(TEXT_SNIPPET | GCS_FILE_PATH),SENTIMENT
 * *   `ML_USE` - Identifies the data set that the current row (file) applies
 * to.
 *     This value can be one of the following:
 *     * `TRAIN` - Rows in this file are used to train the model.
 *     * `TEST` - Rows in this file are used to test the model during training.
 *     * `UNASSIGNED` - Rows in this file are not categorized. They are
 *        Automatically divided into train and test data. 80% for training and
 *        20% for testing.
 * *   `TEXT_SNIPPET` and `GCS_FILE_PATH` are distinguished by a pattern. If
 *     the column content is a valid  Google Cloud Storage file path, that is,
 *     prefixed by "gs://", it is treated as a `GCS_FILE_PATH`. Otherwise, if
 *     the content is enclosed in double quotes (""), it is treated as a
 *     `TEXT_SNIPPET`. For `GCS_FILE_PATH`, the path must lead to a
 *     file with supported extension and UTF-8 encoding, for example,
 *     "gs://folder/content.txt" AutoML imports the file content
 *     as a text snippet. For `TEXT_SNIPPET`, AutoML imports the column content
 *     excluding quotes. In both cases, size of the content must be 128kB or
 *     less in size. For zip files, the size of each file inside the zip must be
 *     128kB or less in size.
 *     The `ML_USE` and `SENTIMENT` columns are optional.
 *     Supported file extensions: .TXT, .PDF, .ZIP
 * *  `SENTIMENT` - An integer between 0 and
 *     Dataset.text_sentiment_dataset_metadata.sentiment_max
 *     (inclusive). Describes the ordinal of the sentiment - higher
 *     value means a more positive sentiment. All the values are
 *     completely relative, i.e. neither 0 needs to mean a negative or
 *     neutral sentiment nor sentiment_max needs to mean a positive one -
 *     it is just required that 0 is the least positive sentiment
 *     in the data, and sentiment_max is the  most positive one.
 *     The SENTIMENT shouldn't be confused with "score" or "magnitude"
 *     from the previous Natural Language Sentiment Analysis API.
 *     All SENTIMENT values between 0 and sentiment_max must be
 *     represented in the imported data. On prediction the same 0 to
 *     sentiment_max range will be used. The difference between
 *     neighboring sentiment values needs not to be uniform, e.g. 1 and
 *     2 may be similar whereas the difference between 2 and 3 may be
 *     large.
 * Sample rows:
 *     TRAIN,"&#64;freewrytin this is way too good for your product",2
 *     gs://folder/content.txt,3
 *     TEST,gs://folder/document.pdf
 *     VALIDATE,gs://folder/text_files.zip,2
 *   </section>
 * </div>
 * **Input field definitions:**
 * `ML_USE`
 * : ("TRAIN" | "VALIDATE" | "TEST" | "UNASSIGNED")
 *   Describes how the given example (file) should be used for model
 *   training. "UNASSIGNED" can be used when user has no preference.
 * `GCS_FILE_PATH`
 * : The path to a file on Google Cloud Storage. For example,
 *   "gs://folder/image1.png".
 * `LABEL`
 * : A display name of an object on an image, video etc., e.g. "dog".
 *   Must be up to 32 characters long and can consist only of ASCII
 *   Latin letters A-Z and a-z, underscores(_), and ASCII digits 0-9.
 *   For each label an AnnotationSpec is created which display_name
 *   becomes the label; AnnotationSpecs are given back in predictions.
 * `BOUNDING_BOX`
 * : (`VERTEX,VERTEX,VERTEX,VERTEX` | `VERTEX,,,VERTEX,,`)
 *   A rectangle parallel to the frame of the example (image,
 *   video). If 4 vertices are given they are connected by edges
 *   in the order provided, if 2 are given they are recognized
 *   as diagonally opposite vertices of the rectangle.
 * `VERTEX`
 * : (`COORDINATE,COORDINATE`)
 *   First coordinate is horizontal (x), the second is vertical (y).
 * `COORDINATE`
 * : A float in 0 to 1 range, relative to total length of
 *   image or video in given dimension. For fractions the
 *   leading non-decimal 0 can be omitted (i.e. 0.3 = .3).
 *   Point 0,0 is in top left.
 * `TEXT_SNIPPET`
 * : The content of a text snippet, UTF-8 encoded, enclosed within
 *   double quotes ("").
 * `DOCUMENT`
 * : A field that provides the textual content with document and the layout
 *   information.
 *  **Errors:**
 *  If any of the provided CSV files can't be parsed or if more than certain
 *  percent of CSV rows cannot be processed then the operation fails and
 *  nothing is imported. Regardless of overall success or failure the per-row
 *  failures, up to a certain count cap, is listed in
 *  Operation.metadata.partial_failures.
 *
 * Generated from protobuf message <code>google.cloud.automl.v1.InputConfig</code>
 */
class InputConfig extends \Google\Protobuf\Internal\Message
{
    /**
     * Additional domain-specific parameters describing the semantic of the
     * imported data, any string must be up to 25000
     * characters long.
     *
     * Generated from protobuf field <code>map<string, string> params = 2;</code>
     */
    private $params;
    protected $source;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\AutoMl\V1\GcsSource $gcs_source
     *           The Google Cloud Storage location for the input content.
     *           For [AutoMl.ImportData][google.cloud.automl.v1.AutoMl.ImportData],
     *           `gcs_source` points to a CSV file with a structure described in
     *           [InputConfig][google.cloud.automl.v1.InputConfig].
     *     @type array|\Google\Protobuf\Internal\MapField $params
     *           Additional domain-specific parameters describing the semantic of the
     *           imported data, any string must be up to 25000
     *           characters long.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Automl\V1\Io::initOnce();
        parent::__construct($data);
    }

    /**
     * The Google Cloud Storage location for the input content.
     * For [AutoMl.ImportData][google.cloud.automl.v1.AutoMl.ImportData],
     * `gcs_source` points to a CSV file with a structure described in
     * [InputConfig][google.cloud.automl.v1.InputConfig].
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.GcsSource gcs_source = 1;</code>
     * @return \Google\Cloud\AutoMl\V1\GcsSource
     */
    public function getGcsSource()
    {
        return $this->readOneof(1);
    }

    /**
     * The Google Cloud Storage location for the input content.
     * For [AutoMl.ImportData][google.cloud.automl.v1.AutoMl.ImportData],
     * `gcs_source` points to a CSV file with a structure described in
     * [InputConfig][google.cloud.automl.v1.InputConfig].
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.GcsSource gcs_source = 1;</code>
     * @param \Google\Cloud\AutoMl\V1\GcsSource $var
     * @return $this
     */
    public function setGcsSource($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AutoMl\V1\GcsSource::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * Additional domain-specific parameters describing the semantic of the
     * imported data, any string must be up to 25000
     * characters long.
     *
     * Generated from protobuf field <code>map<string, string> params = 2;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Additional domain-specific parameters describing the semantic of the
     * imported data, any string must be up to 25000
     * characters long.
     *
     * Generated from protobuf field <code>map<string, string> params = 2;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setParams($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->params = $arr;

        return $this;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->whichOneof("source");
    }

}

