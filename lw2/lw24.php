PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES DOS;

FUNCTION DeletePass(StringSource: STRING): STRING;
VAR
  Ch: CHAR;
  I, PositionPoss: INTEGER;
  Answer: STRING;
BEGIN
  Answer := StringSource;
  FOR I := 1 TO LENGTH(StringSource)
  DO
    BEGIN
      PositionPoss := POS('%20', Answer);
      IF (PositionPoss <> 0)
      THEN
        DeletePass(Answer, PositionPoss, 3) 
    END;
  DeletePass := Answer
END;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  Answer, SourceQueryString: STRING;
  Ch: CHAR;
  LenKey, LenSource: BYTE;
  PositionKeyInSource: STRING; 
  FileMiddle: TEXT;
BEGIN{GetValue}
  Answer := ' ';
  SourceQueryString := DeletePass(GetEnv('QUERY_STRING'));
  LenSource := LENGTH(SourceQueryString);
  LenKey := LENGTH(Key);
  PositionKeyInSource := POS(Key, SourceQueryString) + LenKey;
  DELETE(SourceQueryString, 1, PositionKeyInSource - 1);
  REWRITE(FileMiddle);
  WRITE(FileMiddle, SourceQueryString);
  RESET(FileMiddle);
  READ(FileMiddle, Ch);
  IF Ch = '='
  THEN
    BEGIN
      REWRITE(FileMiddle);
      WRITE(FileMiddle, SourceQueryString);
      RESET(FileMiddle);
      READ(FileMiddle, Ch);
      WHILE NOT EOLN(FileMiddle)
      DO
        BEGIN
          READ(FileMiddle, Ch);
          IF Ch <> '&' THEN Answer := Answer + Ch 
          ELSE BREAK
        END;
    END;
  GetQueryStringParameter := Answer
END;{GetValue}

BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('first_name: ', GetQueryStringParameter('first_name'));
  WRITELN('last_name: ', GetQueryStringParameter('last_name'));
  WRITELN('age: ', GetQueryStringParameter('age'))
END.