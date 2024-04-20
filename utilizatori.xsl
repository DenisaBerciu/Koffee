<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:xlink="http://www.w3.org/1999/xlink">
    <xsl:template match="/">
        <table border="2" width="100%">
            <tr>
                <th style='border: 2px solid black;'>Nume</th>
                <th style='border: 2px solid black;'>Parola</th>
                <th style='border: 2px solid black;'>Rol</th>
                <th style='border: 2px solid black;'>Acțiuni</th>
            </tr>
            <xsl:for-each select="utilizatori/utilizator">
                <tr>
                    <td style='border: 1px solid black;'><xsl:value-of select="nume"/></td>
                    <td style='border: 1px solid black;'><xsl:value-of select="parola"/></td>
                    <td style='border: 1px solid black;'><xsl:value-of select="rol"/></td>
                    <td style='border: 1px solid black;'>
                    <xsl:if test="link/@xlink:href">
                    <a>
                    <xsl:attribute name="href">
                    <xsl:value-of select="link/@xlink:href"/>
                    </xsl:attribute>
                    <xsl:value-of select="link/@xlink:title"/>
                    </a>
                    </xsl:if>
                    </td>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>
</xsl:stylesheet>
