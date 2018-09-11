<div class="wrap">
    <h1>Wordpress Cognition</h1>
    <form method="post" novalidate="novalidate">
        <input name="action" value="save" type="hidden" method="POST">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="<?= MSAT_AccessibilityTools::MSAT_BING_SPEECH_API; ?>">Bing Speech API</label>
                    </th>
                    <td>
                        <input name="<?= MSAT_AccessibilityTools::MSAT_BING_SPEECH_API; ?>" id="<?= MSAT_AccessibilityTools::MSAT_BING_SPEECH_API; ?>" value="<?= $msat_bing_speech_api; ?>" class="regular-text" type="text">
                        <p class="description" id="tagline-description">Click <a href="https://azure.microsoft.com/en-us/services/cognitive-services/speech/" target="_blank">here</a> to grab your Keys.</p>
                    </td>
                </tr>
                <tr>
                    <td><hr></td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= MSAT_AccessibilityTools::MSAT_COMPUTER_VISION_API; ?>">Azure Vision API</label>
                    </th>
                    <td>
                        <input name="<?= MSAT_AccessibilityTools::MSAT_COMPUTER_VISION_API; ?>" id="<?= MSAT_AccessibilityTools::MSAT_COMPUTER_VISION_API; ?>" value="<?= $msat_computer_vision_api; ?>" class="regular-text" type="text">
                        <p class="description" id="tagline-description">Click <a href="https://azure.microsoft.com/en-us/services/cognitive-services/computer-vision/" target="_blank">here</a> to grab your Keys.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= MSAT_AccessibilityTools::MSAT_CONFIDENCE; ?>">Azure Vision Confidence</label>
                    </th>
                    <td>
                        <input name="<?= MSAT_AccessibilityTools::MSAT_CONFIDENCE; ?>" id="<?= MSAT_AccessibilityTools::MSAT_CONFIDENCE; ?>" value="<?= $msat_confidence; ?>" class="regular-text" type="text">
                        <p class="description" id="tagline-description">1-100 (~65 recommended)</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="<?= MSAT_AccessibilityTools::MSAT_PICTURE_SUBTITLE_DESCRIBE_URL; ?>">Azure Vision Endpoint</label>
                    </th>
                    <td>
                        <input name="<?= MSAT_AccessibilityTools::MSAT_PICTURE_SUBTITLE_DESCRIBE_URL; ?>" id="<?= MSAT_AccessibilityTools::MSAT_PICTURE_SUBTITLE_DESCRIBE_URL; ?>" value="<?= $msat_computer_vision_endpoint; ?>" class="regular-text" type="text">
                        <p class="description" id="tagline-description">ex: https://southcentralus.api.cognitive.microsoft.com/vision/v1.0</p>
                    </td>
                </tr>
                <tr>
                    <td><hr></td>
                </tr>
            </tbody>
        </table>

        <p class="submit">
            <input name="submit" id="submit" class="button button-primary" value="Save Options" type="submit">
        </p>
    </form>

</div>