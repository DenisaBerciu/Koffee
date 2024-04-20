<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" omit-xml-declaration="yes" encoding="UTF-8" indent="yes" />
    <xsl:template match="/content">
        <table border="2" width="100%">
            <tr>
                <th style='border: 2px solid black;'>Nume Imagine</th>
                <th style='border: 2px solid black;'>Imagine</th>
                <th style='border: 2px solid black;'>Formula</th>
                <th style='border: 2px solid black;'>Imagine SVG</th>
            </tr>
            <xsl:for-each select="images/image">
                <tr>
                    <td style='border: 1px solid black;'><xsl:value-of select="name"/></td>
                    <td style='border: 1px solid black;'>
                        <img>
                            <xsl:attribute name="src"><xsl:value-of select="src"/></xsl:attribute>
                            <xsl:attribute name="alt"><xsl:value-of select="name"/></xsl:attribute>
                            <xsl:attribute name="width">100px</xsl:attribute>
                            <xsl:attribute name="height">auto</xsl:attribute>
                        </img>
                    </td>
                    <td style='border: 1px solid black;'>
                        <xsl:copy-of select="math"/>
                    </td>
                    <td style='border: 1px solid black;'>
                        <div style="width: 100px; height: 100px;">
                            <xsl:copy-of select="svg/*"/>
                        </div>
                    </td>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>
</xsl:stylesheet>
