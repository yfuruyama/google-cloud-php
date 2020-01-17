<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/secrets/v1beta1/service.proto

namespace Google\Cloud\SecretManager\V1beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Response message for [SecretManagerService.AccessSecretVersion][google.cloud.secrets.v1beta1.SecretManagerService.AccessSecretVersion].
 *
 * Generated from protobuf message <code>google.cloud.secrets.v1beta1.AccessSecretVersionResponse</code>
 */
class AccessSecretVersionResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * The resource name of the [SecretVersion][google.cloud.secrets.v1beta1.SecretVersion] in the format
     * `projects/&#42;&#47;secrets/&#42;&#47;versions/&#42;`.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.resource_reference) = {</code>
     */
    protected $name = '';
    /**
     * Secret payload
     *
     * Generated from protobuf field <code>.google.cloud.secrets.v1beta1.SecretPayload payload = 2;</code>
     */
    protected $payload = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *           The resource name of the [SecretVersion][google.cloud.secrets.v1beta1.SecretVersion] in the format
     *           `projects/&#42;&#47;secrets/&#42;&#47;versions/&#42;`.
     *     @type \Google\Cloud\SecretManager\V1beta1\SecretPayload $payload
     *           Secret payload
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Secrets\V1Beta1\Service::initOnce();
        parent::__construct($data);
    }

    /**
     * The resource name of the [SecretVersion][google.cloud.secrets.v1beta1.SecretVersion] in the format
     * `projects/&#42;&#47;secrets/&#42;&#47;versions/&#42;`.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The resource name of the [SecretVersion][google.cloud.secrets.v1beta1.SecretVersion] in the format
     * `projects/&#42;&#47;secrets/&#42;&#47;versions/&#42;`.
     *
     * Generated from protobuf field <code>string name = 1 [(.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Secret payload
     *
     * Generated from protobuf field <code>.google.cloud.secrets.v1beta1.SecretPayload payload = 2;</code>
     * @return \Google\Cloud\SecretManager\V1beta1\SecretPayload
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Secret payload
     *
     * Generated from protobuf field <code>.google.cloud.secrets.v1beta1.SecretPayload payload = 2;</code>
     * @param \Google\Cloud\SecretManager\V1beta1\SecretPayload $var
     * @return $this
     */
    public function setPayload($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\SecretManager\V1beta1\SecretPayload::class);
        $this->payload = $var;

        return $this;
    }

}

