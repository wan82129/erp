-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2020 年 08 月 03 日 14:29
-- 伺服器版本： 5.7.29-0ubuntu0.18.04.1
-- PHP 版本： 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `erp`
--

-- --------------------------------------------------------

--
-- 資料表結構 `Bar`
--

CREATE TABLE `Bar` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Code` varchar(100) NOT NULL COMMENT '代號',
  `Name` varchar(100) NOT NULL COMMENT '檯名',
  `BasePrice` int(10) NOT NULL COMMENT '基本價',
  `Sections1` float NOT NULL COMMENT '節數',
  `TakeBar` int(10) NOT NULL COMMENT '帶檯',
  `IsCountTime` enum('是','否') NOT NULL DEFAULT '是' COMMENT '計時',
  `BaseMinute` int(10) NOT NULL COMMENT '基本分鐘',
  `TimeoutCount` int(10) NOT NULL COMMENT '逾時計時',
  `Sections2` int(10) NOT NULL COMMENT '節數',
  `SinglePrice` int(10) NOT NULL COMMENT '單價',
  `UpdatedTime` date NOT NULL,
  `Status` enum('Use','Delete') NOT NULL DEFAULT 'Use'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `Customer`
--

CREATE TABLE `Customer` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Code` varchar(100) NOT NULL COMMENT '客戶編號',
  `Name` varchar(100) NOT NULL COMMENT '姓名',
  `Birthday` date DEFAULT NULL COMMENT '生日',
  `Credit` varchar(100) DEFAULT NULL COMMENT '信用額度',
  `Company` varchar(100) DEFAULT NULL COMMENT '公司',
  `IsOpenReceipt` enum('是','否') NOT NULL DEFAULT '是' COMMENT '開發票',
  `ReceiptTitle` varchar(100) DEFAULT NULL COMMENT '發票檯頭',
  `ReceiptAddress` varchar(100) DEFAULT NULL COMMENT '發票地址',
  `GetPaidAddress` varchar(100) DEFAULT NULL COMMENT '收款地址',
  `Contactor` varchar(100) DEFAULT NULL COMMENT '聯絡人',
  `TaxNumber` varchar(100) DEFAULT NULL COMMENT '統一編號',
  `Phone` varchar(100) DEFAULT NULL COMMENT '電話號碼',
  `Note` varchar(100) DEFAULT NULL COMMENT '備註',
  `ReleaseOrderDate` date DEFAULT NULL COMMENT '放單日',
  `GetPaidDate` date DEFAULT NULL COMMENT '收款日',
  `ClearLog` varchar(100) DEFAULT NULL COMMENT '清帳方式',
  `PreUpdatedTime` date NOT NULL COMMENT '前更動日',
  `UpdatedTime` date NOT NULL COMMENT '更動日',
  `LatestConsumpDate` date DEFAULT NULL COMMENT '最後消費日期',
  `StaffCode` varchar(100) NOT NULL COMMENT '業績幹部',
  `CustomerType` varchar(100) DEFAULT NULL COMMENT '客戶類別',
  `Status` enum('Use','Delete') NOT NULL DEFAULT 'Use'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `Customer`
--

INSERT INTO `Customer` (`Id`, `Code`, `Name`, `Birthday`, `Credit`, `Company`, `IsOpenReceipt`, `ReceiptTitle`, `ReceiptAddress`, `GetPaidAddress`, `Contactor`, `TaxNumber`, `Phone`, `Note`, `ReleaseOrderDate`, `GetPaidDate`, `ClearLog`, `PreUpdatedTime`, `UpdatedTime`, `LatestConsumpDate`, `StaffCode`, `CustomerType`, `Status`) VALUES
(1, '123', '客戶A', '2020-07-08', NULL, NULL, '否', NULL, 'ㄇ', 'ㄇ', 'ㄇ', 'ㄇ', 'ㄇ', 'ㄇ', '2020-07-01', '2020-07-15', NULL, '2020-07-28', '2020-07-28', '2020-07-29', '0AA123', NULL, 'Delete'),
(2, '456', '客戶b', '2020-06-29', '5546', '家裡蹲', '否', '45465', 'ㄆ', 'cvbcb', '不告訴你', '47643', '16776546', 'nOTE', '2020-07-01', '2020-07-11', 'ALL CLEAR', '2020-07-28', '2020-07-29', '2020-07-05', 'A01234', 'b', 'Use');

-- --------------------------------------------------------

--
-- 資料表結構 `Food`
--

CREATE TABLE `Food` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT '編號',
  `Code` varchar(100) NOT NULL COMMENT '代號',
  `Name` varchar(100) NOT NULL COMMENT '品名',
  `Count` varchar(100) NOT NULL COMMENT '單位?(一條10包)',
  `Type` enum('酒','吧','廚') NOT NULL DEFAULT '酒' COMMENT '物品類別',
  `IsDefaultOpeningFood` enum('是','否') NOT NULL DEFAULT '是' COMMENT '是否開桌菜',
  `DefaultOpeningFoodCountPerRoomType` varchar(100) DEFAULT NULL COMMENT '根據包廂級別的開桌數量',
  `IsFreeService` enum('是','否') NOT NULL DEFAULT '否' COMMENT '可否做招待',
  `WineType` varchar(100) DEFAULT NULL COMMENT '酒別',
  `SelfHelpPrice` int(10) DEFAULT NULL COMMENT '自助售價',
  `Price` int(10) DEFAULT NULL COMMENT '售價',
  `PremiumPrice` int(10) DEFAULT NULL COMMENT '會員售價',
  `SafeCount` int(10) DEFAULT NULL COMMENT '安全存量',
  `Note` varchar(100) DEFAULT NULL COMMENT '備註',
  `IsCount` enum('是','否') NOT NULL DEFAULT '是' COMMENT '計存量',
  `CurrentCount` int(10) DEFAULT NULL COMMENT '目前存量',
  `LatestPurchaseDate` date DEFAULT NULL COMMENT '最近進貨',
  `PurchasePrice` int(10) DEFAULT NULL COMMENT '進貨單價',
  `PurchaseCompany` varchar(100) DEFAULT NULL COMMENT '進貨廠商',
  `IsScore` enum('是','否') NOT NULL DEFAULT '是' COMMENT '計業績',
  `IsLowestThershold` enum('是','否') NOT NULL DEFAULT '是' COMMENT '抵低消',
  `IsTurnover` enum('是','否') NOT NULL DEFAULT '是' COMMENT '計營業額',
  `UpdatedTime` date NOT NULL COMMENT '更動日期',
  `Status` enum('Use','Delete') NOT NULL COMMENT '狀態'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `Food`
--

INSERT INTO `Food` (`Id`, `Code`, `Name`, `Count`, `Type`, `IsDefaultOpeningFood`, `DefaultOpeningFoodCountPerRoomType`, `IsFreeService`, `WineType`, `SelfHelpPrice`, `Price`, `PremiumPrice`, `SafeCount`, `Note`, `IsCount`, `CurrentCount`, `LatestPurchaseDate`, `PurchasePrice`, `PurchaseCompany`, `IsScore`, `IsLowestThershold`, `IsTurnover`, `UpdatedTime`, `Status`) VALUES
(1, 'item01', 'asddasd', 'asdsa', '酒', '否', '6,6,5,4,3,2,2', '否', '123', 1, 1, 1, NULL, '1', '否', NULL, '2020-08-10', 1, '2', '否', '否', '否', '2020-08-01', 'Delete'),
(2, 'i01', '餐點1', '1盤', '廚', '否', '1,2,3,4,5,68,8', '否', NULL, NULL, NULL, NULL, NULL, NULL, '是', NULL, '2020-07-15', NULL, NULL, '否', '否', '否', '2020-08-02', 'Use');

-- --------------------------------------------------------

--
-- 資料表結構 `Room`
--

CREATE TABLE `Room` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT '編號',
  `Code` varchar(100) NOT NULL COMMENT '代號',
  `Name` varchar(100) NOT NULL COMMENT '包廂名稱',
  `LimitCount` int(10) DEFAULT NULL COMMENT '可容納人數',
  `MorningPrice` int(10) DEFAULT NULL COMMENT '早班價',
  `NightPrice` int(10) DEFAULT NULL COMMENT '晚班價',
  `TimeoutPrice` int(10) DEFAULT NULL COMMENT '逾時價',
  `Level` enum('一般','一級','二級','三級','四級','五級','六級') NOT NULL DEFAULT '一般' COMMENT '級數',
  `HaveDefaultOpeningFood` enum('是','否') NOT NULL DEFAULT '是' COMMENT '是否有開桌菜',
  `Note` varchar(100) DEFAULT NULL COMMENT '備註',
  `UpdatedTime` date NOT NULL,
  `Status` enum('Use','Delete') NOT NULL DEFAULT 'Use'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `Room`
--

INSERT INTO `Room` (`Id`, `Code`, `Name`, `LimitCount`, `MorningPrice`, `NightPrice`, `TimeoutPrice`, `Level`, `HaveDefaultOpeningFood`, `Note`, `UpdatedTime`, `Status`) VALUES
(1, 'R03', '包廂2', 4, 5, 6, 7, '一級', '否', 'qwer', '2020-07-31', 'Use');

-- --------------------------------------------------------

--
-- 資料表結構 `Staff`
--

CREATE TABLE `Staff` (
  `Id` int(10) UNSIGNED NOT NULL COMMENT '員工Id',
  `Code` varchar(100) NOT NULL COMMENT '員工代號',
  `Name` varchar(100) NOT NULL COMMENT '員工名稱',
  `RealName` varchar(100) DEFAULT NULL COMMENT '小姐本名',
  `NickName` varchar(100) DEFAULT NULL COMMENT '員工簡稱',
  `SerialNumber` varchar(100) DEFAULT NULL COMMENT '身分證號',
  `AccessLevel` enum('董','常董','小姐','櫃檯','會計','控檯') NOT NULL DEFAULT '董' COMMENT '職務',
  `Phone` varchar(100) DEFAULT NULL COMMENT '電話',
  `Birthday` date DEFAULT NULL COMMENT '生日',
  `ContactAddress` varchar(100) DEFAULT NULL COMMENT '聯絡地址',
  `ResidenceAddress` varchar(100) DEFAULT NULL COMMENT '戶籍地址',
  `Note` varchar(100) DEFAULT NULL COMMENT '備註',
  `IsDisable` enum('是','否') NOT NULL DEFAULT '否' COMMENT '下檔',
  `ArrivedDate` date DEFAULT NULL COMMENT '到職日期',
  `LeavedDate` date DEFAULT NULL COMMENT '離職日期',
  `UpdatedTime` date NOT NULL COMMENT '更動日期',
  `Status` enum('Use','Delete') NOT NULL DEFAULT 'Use' COMMENT '狀態',
  `Manager` varchar(100) DEFAULT NULL COMMENT '經紀人',
  `FileType` enum('A','B','C') NOT NULL DEFAULT 'A' COMMENT '檔別',
  `StaffSalaryType` varchar(100) DEFAULT NULL COMMENT '幹部薪別',
  `LadySalaryType` varchar(100) DEFAULT NULL COMMENT '小姐薪別',
  `ShowColumn` varchar(100) DEFAULT NULL COMMENT 'Show',
  `CardNumber` varchar(100) DEFAULT NULL COMMENT '卡號',
  `SalaryPerDay` int(10) DEFAULT NULL COMMENT '每日保薪',
  `Liability` int(10) DEFAULT NULL COMMENT '責任額',
  `BarFeeType` varchar(100) DEFAULT NULL COMMENT '檯費類別',
  `BrokerageFeePerDay` int(10) DEFAULT NULL COMMENT '每日經紀費',
  `BrokerageFeePerSection` int(10) DEFAULT NULL COMMENT '每節經紀費',
  `CleaningFee` int(10) DEFAULT NULL COMMENT '清潔費',
  `SectionPerDay` int(10) DEFAULT NULL COMMENT '日回節數',
  `SectionCost1` int(10) DEFAULT NULL COMMENT '節抽薪1',
  `SectionCost2` int(10) DEFAULT NULL COMMENT '節抽薪2',
  `TakeBarFee` int(10) DEFAULT NULL COMMENT '帶檯費'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `Staff`
--

INSERT INTO `Staff` (`Id`, `Code`, `Name`, `RealName`, `NickName`, `SerialNumber`, `AccessLevel`, `Phone`, `Birthday`, `ContactAddress`, `ResidenceAddress`, `Note`, `IsDisable`, `ArrivedDate`, `LeavedDate`, `UpdatedTime`, `Status`, `Manager`, `FileType`, `StaffSalaryType`, `LadySalaryType`, `ShowColumn`, `CardNumber`, `SalaryPerDay`, `Liability`, `BarFeeType`, `BrokerageFeePerDay`, `BrokerageFeePerSection`, `CleaningFee`, `SectionPerDay`, `SectionCost1`, `SectionCost2`, `TakeBarFee`) VALUES
(1, '0AA123', '小大', '安安', '小', '123123', '小姐', '01234', '2013-01-07', '台灣台灣台灣台灣台灣台灣ㄒ', '台灣台灣台灣台灣台灣台灣台灣台灣台灣台灣台灣台灣', '備註備註備註備註備註備註備註', '是', '2020-06-30', '2020-07-29', '2020-07-28', 'Use', '無', 'B', '456789', NULL, NULL, NULL, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0),
(4, 'A01234', 'kkAI', '不好說', 'kai', '123456', '董', NULL, '2020-07-06', 'ert', 'cvb', 'yyyyy', '否', '2020-07-14', '2020-07-30', '2020-07-29', 'Use', '789', 'A', '5', '5', '5', '5', 5, 500, '789', 123, 123, 456, 5, 5, 5, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `SystemParameters`
--

CREATE TABLE `SystemParameters` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Company` varchar(100) NOT NULL COMMENT '公司名稱',
  `TaxNumber` int(10) NOT NULL COMMENT '統一編號',
  `BusinessTime` varchar(100) NOT NULL COMMENT '營業時間',
  `ClosingTime` varchar(100) NOT NULL COMMENT '歇業時間',
  `Sections` int(10) NOT NULL COMMENT '最多幾節',
  `FinishPaidDeadline` int(10) NOT NULL COMMENT '最長完帳期限',
  `GetPaidClearLog` int(10) NOT NULL COMMENT '幾日內入現拆帳',
  `StaffServicePercentage` float NOT NULL COMMENT '幹部可招待額業績百分比',
  `DeadlineExpireDayInterest` float NOT NULL COMMENT '超過消帳期限日息',
  `StaffClearLogType` varchar(100) NOT NULL COMMENT '內定幹部拆帳類別',
  `BarPaidType` varchar(100) NOT NULL COMMENT '內定檯費拆帳類別',
  `IsCountServiceFee` enum('是','否') NOT NULL DEFAULT '是' COMMENT '計算服務費',
  `ServiceFeePercentage` int(10) NOT NULL COMMENT '服務費成數',
  `IsCountBarPaidServiceFee` enum('是','否') NOT NULL DEFAULT '是' COMMENT '檯費計算服務費',
  `LadyCodeFirstChar` varchar(100) NOT NULL COMMENT '小姐代號第一碼',
  `LadyComeLastTime` varchar(100) NOT NULL COMMENT '小姐算進場最後時間',
  `BarSeatRound` int(10) NOT NULL COMMENT '座檯方式座一轉',
  `LowestThershold` int(10) NOT NULL COMMENT '低消每人幾元',
  `LowestThersholdWithWine` int(10) NOT NULL COMMENT '低消每人幾元(寄酒)',
  `LongestTicketDay` int(10) NOT NULL COMMENT '最長票期',
  `StaffPassCode` varchar(100) NOT NULL COMMENT '幹部通行碼',
  `RoomCodeFirstChar` varchar(100) NOT NULL COMMENT '房號第一碼',
  `StaffLateTime` varchar(100) NOT NULL COMMENT '員工遲到時間',
  `StaffAwayTime` varchar(100) NOT NULL COMMENT '員工早退時間',
  `UpdatedTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `SystemParameters`
--

INSERT INTO `SystemParameters` (`Id`, `Company`, `TaxNumber`, `BusinessTime`, `ClosingTime`, `Sections`, `FinishPaidDeadline`, `GetPaidClearLog`, `StaffServicePercentage`, `DeadlineExpireDayInterest`, `StaffClearLogType`, `BarPaidType`, `IsCountServiceFee`, `ServiceFeePercentage`, `IsCountBarPaidServiceFee`, `LadyCodeFirstChar`, `LadyComeLastTime`, `BarSeatRound`, `LowestThershold`, `LowestThersholdWithWine`, `LongestTicketDay`, `StaffPassCode`, `RoomCodeFirstChar`, `StaffLateTime`, `StaffAwayTime`, `UpdatedTime`) VALUES
(1, '測試ERP', 56745436, '08:30', '17:00', 90, 90, 7, 3.123, 0.68, 'A', 'A', '否', 10, '否', '2', '09:30', 4, 800, 8000, 90, '900', 'A,R,K,P', '08:32', '03:29', '2020-08-03');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `Bar`
--
ALTER TABLE `Bar`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Code` (`Code`),
  ADD KEY `Name` (`Name`),
  ADD KEY `Status` (`Status`);

--
-- 資料表索引 `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Code` (`Code`),
  ADD KEY `Name` (`Name`),
  ADD KEY `StaffId` (`StaffCode`),
  ADD KEY `StaffId_2` (`StaffCode`),
  ADD KEY `StaffId_3` (`StaffCode`),
  ADD KEY `Status` (`Status`);

--
-- 資料表索引 `Food`
--
ALTER TABLE `Food`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Code` (`Code`),
  ADD KEY `Name` (`Name`);

--
-- 資料表索引 `Room`
--
ALTER TABLE `Room`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Code` (`Code`),
  ADD KEY `Name` (`Name`);

--
-- 資料表索引 `Staff`
--
ALTER TABLE `Staff`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id` (`Id`),
  ADD KEY `Code` (`Code`,`Name`),
  ADD KEY `Status` (`Status`);

--
-- 資料表索引 `SystemParameters`
--
ALTER TABLE `SystemParameters`
  ADD PRIMARY KEY (`Id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `Bar`
--
ALTER TABLE `Bar`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `Customer`
--
ALTER TABLE `Customer`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `Food`
--
ALTER TABLE `Food`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '編號', AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `Room`
--
ALTER TABLE `Room`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '編號', AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `Staff`
--
ALTER TABLE `Staff`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '員工Id', AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `SystemParameters`
--
ALTER TABLE `SystemParameters`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
