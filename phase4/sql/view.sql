
--
-- Temporary view structure for view `deletehasgradedhistoryview`
--

DROP TABLE IF EXISTS `deletehasgradedhistoryview`;
/*!50001 DROP VIEW IF EXISTS `deletehasgradedhistoryview`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `deletehasgradedhistoryview` AS SELECT 
 1 AS `courseID`,
 1 AS `classID`,
 1 AS `studentID`,
 1 AS `grade`,
 1 AS `deletegraded`,
 1 AS `code`,
 1 AS `name`,
 1 AS `credit`,
 1 AS `departmentID`,
 1 AS `year`,
 1 AS `term`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `instructorgivescourseJoin`
--

DROP TABLE IF EXISTS `instructorgivescourseJoin`;
/*!50001 DROP VIEW IF EXISTS `instructorgivescourseJoin`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `instructorgivescourseJoin` AS SELECT 
 1 AS `instructorID`,
 1 AS `InstructorName`,
 1 AS `InstructorSurname`,
 1 AS `courseID`,
 1 AS `CourseCode`,
 1 AS `CourseName`,
 1 AS `classID`,
 1 AS `sectionID`,
 1 AS `credit`,
 1 AS `year`,
 1 AS `term`,
 1 AS `day1`,
 1 AS `startTime1`,
 1 AS `endTime1`,
 1 AS `day2`,
 1 AS `startTime2`,
 1 AS `endTime2`,
 1 AS `day3`,
 1 AS `startTime3`,
 1 AS `endTime3`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `joincourseclasssection`
--

DROP TABLE IF EXISTS `joincourseclasssection`;
/*!50001 DROP VIEW IF EXISTS `joincourseclasssection`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `joincourseclasssection` AS SELECT 
 1 AS `courseID`,
 1 AS `CourseCode`,
 1 AS `CourseName`,
 1 AS `credit`,
 1 AS `departmentID`,
 1 AS `classID`,
 1 AS `year`,
 1 AS `term`,
 1 AS `sectionID`,
 1 AS `quota`,
 1 AS `SectionLocation`,
 1 AS `day1`,
 1 AS `startTime1`,
 1 AS `endTime1`,
 1 AS `day2`,
 1 AS `startTime2`,
 1 AS `endTime2`,
 1 AS `day3`,
 1 AS `startTime3`,
 1 AS `endTime3`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `joininstructordepartmentfaculty`
--

DROP TABLE IF EXISTS `joininstructordepartmentfaculty`;
/*!50001 DROP VIEW IF EXISTS `joininstructordepartmentfaculty`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `joininstructordepartmentfaculty` AS SELECT 
 1 AS `instructorID`,
 1 AS `instructorName`,
 1 AS `instructorSurname`,
 1 AS `departmentID`,
 1 AS `departmentName`,
 1 AS `location`,
 1 AS `facultyID`,
 1 AS `facultyName`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `joinstudentdepartmentfaculty`
--

DROP TABLE IF EXISTS `joinstudentdepartmentfaculty`;
/*!50001 DROP VIEW IF EXISTS `joinstudentdepartmentfaculty`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `joinstudentdepartmentfaculty` AS SELECT 
 1 AS `studentID`,
 1 AS `studentName`,
 1 AS `studentSurname`,
 1 AS `collectedCredits`,
 1 AS `collectedGrade`,
 1 AS `startYear`,
 1 AS `advisor`,
 1 AS `departmentID`,
 1 AS `departmentName`,
 1 AS `facultyID`,
 1 AS `facultyName`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `quotahistoryView`
--

DROP TABLE IF EXISTS `quotahistoryView`;
/*!50001 DROP VIEW IF EXISTS `quotahistoryView`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `quotahistoryView` AS SELECT 
 1 AS `courseID`,
 1 AS `CourseCode`,
 1 AS `CourseName`,
 1 AS `credit`,
 1 AS `ClassYear`,
 1 AS `ClassTerm`,
 1 AS `classID`,
 1 AS `sectionID`,
 1 AS `instructorID`,
 1 AS `InstructorName`,
 1 AS `InstructorSurname`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `studenthasgradedJoin`
--

DROP TABLE IF EXISTS `studenthasgradedJoin`;
/*!50001 DROP VIEW IF EXISTS `studenthasgradedJoin`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `studenthasgradedJoin` AS SELECT 
 1 AS `courseID`,
 1 AS `CourseCode`,
 1 AS `CourseName`,
 1 AS `studentID`,
 1 AS `classID`,
 1 AS `grade`,
 1 AS `StudentName`,
 1 AS `StudentSurname`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `studenttakencourseJoin`
--

DROP TABLE IF EXISTS `studenttakencourseJoin`;
/*!50001 DROP VIEW IF EXISTS `studenttakencourseJoin`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `studenttakencourseJoin` AS SELECT 
 1 AS `studentID`,
 1 AS `StudentName`,
 1 AS `StudentSurname`,
 1 AS `courseID`,
 1 AS `CourseCode`,
 1 AS `CourseName`,
 1 AS `classID`,
 1 AS `sectionID`,
 1 AS `credit`,
 1 AS `year`,
 1 AS `term`,
 1 AS `day1`,
 1 AS `startTime1`,
 1 AS `endTime1`,
 1 AS `day2`,
 1 AS `startTime2`,
 1 AS `endTime2`,
 1 AS `day3`,
 1 AS `startTime3`,
 1 AS `endTime3`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `takedropcoursecountView`
--

DROP TABLE IF EXISTS `takedropcoursecountView`;
/*!50001 DROP VIEW IF EXISTS `takedropcoursecountView`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `takedropcoursecountView` AS SELECT 
 1 AS `ctd`,
 1 AS `count`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `takedropcoursehistoryView`
--

DROP TABLE IF EXISTS `takedropcoursehistoryView`;
/*!50001 DROP VIEW IF EXISTS `takedropcoursehistoryView`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `takedropcoursehistoryView` AS SELECT 
 1 AS `studentID`,
 1 AS `StudentName`,
 1 AS `StudentSurname`,
 1 AS `StudentDepartment`,
 1 AS `courseID`,
 1 AS `classID`,
 1 AS `sectionID`,
 1 AS `takedrop`,
 1 AS `CourseCode`,
 1 AS `CourseName`,
 1 AS `credit`,
 1 AS `CourseDepartment`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `takedropdepartmentcountView`
--

DROP TABLE IF EXISTS `takedropdepartmentcountView`;
/*!50001 DROP VIEW IF EXISTS `takedropdepartmentcountView`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `takedropdepartmentcountView` AS SELECT 
 1 AS `dtd`,
 1 AS `count`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `takedropfacultycountView`
--

DROP TABLE IF EXISTS `takedropfacultycountView`;
/*!50001 DROP VIEW IF EXISTS `takedropfacultycountView`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `takedropfacultycountView` AS SELECT 
 1 AS `ftd`,
 1 AS `count`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `deletehasgradedhistoryview`
--

/*!50001 DROP VIEW IF EXISTS `deletehasgradedhistoryview`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `deletehasgradedhistoryview` AS select `tbl`.`courseID` AS `courseID`,`tbl`.`classID` AS `classID`,`tbl`.`studentID` AS `studentID`,`tbl`.`grade` AS `grade`,`tbl`.`deletegraded` AS `deletegraded`,`tbl`.`code` AS `code`,`tbl`.`name` AS `name`,`tbl`.`credit` AS `credit`,`tbl`.`departmentID` AS `departmentID`,`Class`.`year` AS `year`,`Class`.`term` AS `term` from ((select `DeleteHasGradedCourseHistory`.`courseID` AS `courseID`,`DeleteHasGradedCourseHistory`.`studentID` AS `studentID`,`DeleteHasGradedCourseHistory`.`classID` AS `classID`,`DeleteHasGradedCourseHistory`.`grade` AS `grade`,`DeleteHasGradedCourseHistory`.`deletegraded` AS `deletegraded`,`Course`.`code` AS `code`,`Course`.`name` AS `name`,`Course`.`credit` AS `credit`,`Course`.`departmentID` AS `departmentID` from (`DeleteHasGradedCourseHistory` join `Course` on((`DeleteHasGradedCourseHistory`.`courseID` = `Course`.`courseID`)))) `tbl` join `Class` on(((`tbl`.`courseID` = `Class`.`courseID`) and (`tbl`.`classID` = `Class`.`classID`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `instructorgivescourseJoin`
--

/*!50001 DROP VIEW IF EXISTS `instructorgivescourseJoin`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `instructorgivescourseJoin` AS select `I`.`instructorID` AS `instructorID`,`I`.`name` AS `InstructorName`,`I`.`surname` AS `InstructorSurname`,`CCS`.`courseID` AS `courseID`,`CCS`.`CourseCode` AS `CourseCode`,`CCS`.`CourseName` AS `CourseName`,`CCS`.`classID` AS `classID`,`CCS`.`sectionID` AS `sectionID`,`CCS`.`credit` AS `credit`,`CCS`.`year` AS `year`,`CCS`.`term` AS `term`,`CCS`.`day1` AS `day1`,`CCS`.`startTime1` AS `startTime1`,`CCS`.`endTime1` AS `endTime1`,`CCS`.`day2` AS `day2`,`CCS`.`startTime2` AS `startTime2`,`CCS`.`endTime2` AS `endTime2`,`CCS`.`day3` AS `day3`,`CCS`.`startTime3` AS `startTime3`,`CCS`.`endTime3` AS `endTime3` from ((`Instructor` `I` join `joincourseclasssection` `CCS`) join `InstructorGivesCourse` `IGC`) where ((`IGC`.`instructorID` = `I`.`instructorID`) and (`IGC`.`classID` = `CCS`.`classID`) and (`IGC`.`sectionID` = `CCS`.`sectionID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `joincourseclasssection`
--

/*!50001 DROP VIEW IF EXISTS `joincourseclasssection`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `joincourseclasssection` AS select `CO`.`courseID` AS `courseID`,`CO`.`code` AS `CourseCode`,`CO`.`name` AS `CourseName`,`CO`.`credit` AS `credit`,`CO`.`departmentID` AS `departmentID`,`CL`.`classID` AS `classID`,`CL`.`year` AS `year`,`CL`.`term` AS `term`,`S`.`sectionID` AS `sectionID`,`S`.`quota` AS `quota`,`S`.`location` AS `SectionLocation`,`S`.`day1` AS `day1`,`S`.`startTime1` AS `startTime1`,`S`.`endTime1` AS `endTime1`,`S`.`day2` AS `day2`,`S`.`startTime2` AS `startTime2`,`S`.`endTime2` AS `endTime2`,`S`.`day3` AS `day3`,`S`.`startTime3` AS `startTime3`,`S`.`endTime3` AS `endTime3` from ((`Course` `CO` join `Class` `CL`) join `Section` `S`) where ((`CO`.`courseID` = `CL`.`courseID`) and (`S`.`classID` = `CL`.`classID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `joininstructordepartmentfaculty`
--

/*!50001 DROP VIEW IF EXISTS `joininstructordepartmentfaculty`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `joininstructordepartmentfaculty` AS select `ins`.`instructorID` AS `instructorID`,`ins`.`name` AS `instructorName`,`ins`.`surname` AS `instructorSurname`,`tblFacDep`.`departmentID` AS `departmentID`,`tblFacDep`.`departmentName` AS `departmentName`,`tblFacDep`.`location` AS `location`,`tblFacDep`.`facultyID` AS `facultyID`,`tblFacDep`.`facultyName` AS `facultyName` from ((select `dep`.`departmentID` AS `departmentID`,`dep`.`name` AS `departmentName`,`dep`.`location` AS `location`,`fac`.`facultyID` AS `facultyID`,`fac`.`name` AS `facultyName` from (`Department` `dep` join `Faculty` `fac`) where (`dep`.`facultyID` = `fac`.`facultyID`)) `tblFacDep` join `Instructor` `ins`) where (`ins`.`departmentID` = `tblFacDep`.`departmentID`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `joinstudentdepartmentfaculty`
--

/*!50001 DROP VIEW IF EXISTS `joinstudentdepartmentfaculty`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `joinstudentdepartmentfaculty` AS select `Student`.`studentID` AS `studentID`,`Student`.`name` AS `studentName`,`Student`.`surname` AS `studentSurname`,`Student`.`collectedCredits` AS `collectedCredits`,`Student`.`collectedGrade` AS `collectedGrade`,`Student`.`startYear` AS `startYear`,`Student`.`advisor` AS `advisor`,`tbl`.`departmentID` AS `departmentID`,`tbl`.`departmentName` AS `departmentName`,`tbl`.`facultyID` AS `facultyID`,`tbl`.`facultyName` AS `facultyName` from ((select `Faculty`.`facultyID` AS `facultyID`,`Department`.`departmentID` AS `departmentID`,`Faculty`.`name` AS `facultyName`,`Department`.`name` AS `departmentName` from (`Faculty` join `Department` on((`Faculty`.`facultyID` = `Department`.`facultyID`)))) `tbl` join `Student` on((`tbl`.`departmentID` = `Student`.`departmentID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `quotahistoryView`
--

/*!50001 DROP VIEW IF EXISTS `quotahistoryView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `quotahistoryView` AS select `instructorgivescourseJoin`.`courseID` AS `courseID`,`instructorgivescourseJoin`.`CourseCode` AS `CourseCode`,`instructorgivescourseJoin`.`CourseName` AS `CourseName`,`instructorgivescourseJoin`.`credit` AS `credit`,`instructorgivescourseJoin`.`year` AS `ClassYear`,`instructorgivescourseJoin`.`term` AS `ClassTerm`,`QuotaHistory`.`classID` AS `classID`,`QuotaHistory`.`sectionID` AS `sectionID`,`instructorgivescourseJoin`.`instructorID` AS `instructorID`,`instructorgivescourseJoin`.`InstructorName` AS `InstructorName`,`instructorgivescourseJoin`.`InstructorSurname` AS `InstructorSurname` from (`QuotaHistory` join `instructorgivescourseJoin` on((`QuotaHistory`.`classID` = `instructorgivescourseJoin`.`classID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `studenthasgradedJoin`
--

/*!50001 DROP VIEW IF EXISTS `studenthasgradedJoin`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `studenthasgradedJoin` AS select `C`.`courseID` AS `courseID`,`C`.`code` AS `CourseCode`,`C`.`name` AS `CourseName`,`tbl`.`studentID` AS `studentID`,`tbl`.`classID` AS `classID`,`tbl`.`grade` AS `grade`,`tbl`.`name` AS `StudentName`,`tbl`.`surname` AS `StudentSurname` from (`Course` `C` join (select `StudentHasGraded`.`studentID` AS `studentID`,`StudentHasGraded`.`courseID` AS `courseID`,`StudentHasGraded`.`classID` AS `classID`,`StudentHasGraded`.`grade` AS `grade`,`Student`.`name` AS `name`,`Student`.`surname` AS `surname`,`Student`.`creditLimit` AS `creditLimit`,`Student`.`startYear` AS `startYear`,`Student`.`collectedCredits` AS `collectedCredits`,`Student`.`collectedGrade` AS `collectedGrade`,`Student`.`departmentID` AS `departmentID`,`Student`.`advisor` AS `advisor`,`Student`.`graduate` AS `graduate` from (`StudentHasGraded` join `Student` on((`StudentHasGraded`.`studentID` = `Student`.`studentID`)))) `tbl` on((`C`.`courseID` = `tbl`.`courseID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `studenttakencourseJoin`
--

/*!50001 DROP VIEW IF EXISTS `studenttakencourseJoin`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `studenttakencourseJoin` AS select `S`.`studentID` AS `studentID`,`S`.`name` AS `StudentName`,`S`.`surname` AS `StudentSurname`,`CCS`.`courseID` AS `courseID`,`CCS`.`CourseCode` AS `CourseCode`,`CCS`.`CourseName` AS `CourseName`,`CCS`.`classID` AS `classID`,`CCS`.`sectionID` AS `sectionID`,`CCS`.`credit` AS `credit`,`CCS`.`year` AS `year`,`CCS`.`term` AS `term`,`CCS`.`day1` AS `day1`,`CCS`.`startTime1` AS `startTime1`,`CCS`.`endTime1` AS `endTime1`,`CCS`.`day2` AS `day2`,`CCS`.`startTime2` AS `startTime2`,`CCS`.`endTime2` AS `endTime2`,`CCS`.`day3` AS `day3`,`CCS`.`startTime3` AS `startTime3`,`CCS`.`endTime3` AS `endTime3` from ((`Student` `S` join `joincourseclasssection` `CCS`) join `StudentTakenCourse` `STC`) where ((`STC`.`studentID` = `S`.`studentID`) and (`STC`.`classID` = `CCS`.`classID`) and (`STC`.`sectionID` = `CCS`.`sectionID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `takedropcoursecountView`
--

/*!50001 DROP VIEW IF EXISTS `takedropcoursecountView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `takedropcoursecountView` AS select concat(`Co`.`name`,convert(`TDH`.`takedrop` using utf8mb4)) AS `ctd`,count(0) AS `count` from (((`StudentTakeDropCourseHistory` `TDH` join `Class` `Cl`) join `Course` `Co`) join `Department` `De`) where ((`Cl`.`courseID` = `Co`.`courseID`) and (`TDH`.`classID` = `Cl`.`classID`) and (`De`.`departmentID` = `Co`.`departmentID`)) group by `Co`.`name`,`TDH`.`takedrop` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `takedropcoursehistoryView`
--

/*!50001 DROP VIEW IF EXISTS `takedropcoursehistoryView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `takedropcoursehistoryView` AS select `tbl2`.`studentID` AS `studentID`,`tbl2`.`StudentName` AS `StudentName`,`tbl2`.`StudentSurname` AS `StudentSurname`,`tbl2`.`StudentDepartment` AS `StudentDepartment`,`tbl2`.`courseID` AS `courseID`,`tbl2`.`classID` AS `classID`,`tbl2`.`sectionID` AS `sectionID`,`tbl2`.`takedrop` AS `takedrop`,`Course`.`code` AS `CourseCode`,`Course`.`name` AS `CourseName`,`Course`.`credit` AS `credit`,`Course`.`departmentID` AS `CourseDepartment` from ((select `tbl`.`classID` AS `classID`,`tbl`.`studentID` AS `studentID`,`tbl`.`sectionID` AS `sectionID`,`tbl`.`takedrop` AS `takedrop`,`tbl`.`StudentName` AS `StudentName`,`tbl`.`StudentSurname` AS `StudentSurname`,`tbl`.`StudentDepartment` AS `StudentDepartment`,`Class`.`courseID` AS `courseID`,`Class`.`year` AS `year`,`Class`.`term` AS `term` from ((select `StudentTakeDropCourseHistory`.`studentID` AS `studentID`,`StudentTakeDropCourseHistory`.`classID` AS `classID`,`StudentTakeDropCourseHistory`.`sectionID` AS `sectionID`,`StudentTakeDropCourseHistory`.`takedrop` AS `takedrop`,`Student`.`name` AS `StudentName`,`Student`.`surname` AS `StudentSurname`,`Student`.`departmentID` AS `StudentDepartment` from (`StudentTakeDropCourseHistory` join `Student` on((`StudentTakeDropCourseHistory`.`studentID` = `Student`.`studentID`)))) `tbl` join `Class` on((`tbl`.`classID` = `Class`.`classID`)))) `tbl2` join `Course` on((`tbl2`.`courseID` = `Course`.`courseID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `takedropdepartmentcountView`
--

/*!50001 DROP VIEW IF EXISTS `takedropdepartmentcountView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `takedropdepartmentcountView` AS select concat(`De`.`name`,convert(`TDH`.`takedrop` using utf8mb4)) AS `dtd`,count(0) AS `count` from (((`StudentTakeDropCourseHistory` `TDH` join `Class` `Cl`) join `Course` `Co`) join `Department` `De`) where ((`Cl`.`courseID` = `Co`.`courseID`) and (`TDH`.`classID` = `Cl`.`classID`) and (`De`.`departmentID` = `Co`.`departmentID`)) group by `De`.`departmentID`,`TDH`.`takedrop` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `takedropfacultycountView`
--

/*!50001 DROP VIEW IF EXISTS `takedropfacultycountView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`kole`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `takedropfacultycountView` AS select concat(`SDF`.`facultyName`,convert(`TDH`.`takedrop` using utf8mb4)) AS `ftd`,count(0) AS `count` from (`StudentTakeDropCourseHistory` `TDH` join `joinstudentdepartmentfaculty` `SDF`) where (`TDH`.`studentID` = `SDF`.`studentID`) group by `SDF`.`facultyName`,`TDH`.`takedrop` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-28 14:18:53
