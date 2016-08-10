<xsl:stylesheet version="3.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output omit-xml-declaration="yes" method="text" />
    <xsl:strip-space elements="*" />

    <xsl:template match="/">
        <xsl:apply-templates />
    </xsl:template>

    <xsl:template match="article[starts-with(@class, 'main-content')]">
        {
            "name": "<xsl:value-of select="normalize-space(./h1)" />"
            <xsl:call-template name="pokemon_type" />
        }
    </xsl:template>

    <xsl:template match="h2[normalize-space() = 'Pokédex data']" name="pokemon_type">
        "type": [<xsl:value-of select="../table/tbody/tr[position() = 2]/td" />]
    </xsl:template>

    <xsl:template match="head" />
    <xsl:template match="nav" />
    <xsl:template match="footer" />
    <xsl:template match="script" />
    <xsl:template match="style" />
    <xsl:template match="ul[contains(@class, 'nav-list')]" />
    <xsl:template match="*[@class='svtabs-tab-list']" />

</xsl:stylesheet>
