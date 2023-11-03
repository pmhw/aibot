-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2023-11-03 19:25:16
-- 服务器版本： 5.6.50-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aibot_pmhapp_com`
--

-- --------------------------------------------------------

--
-- 表的结构 `ect_admin`
--

CREATE TABLE IF NOT EXISTS `ect_admin` (
  `id` int(11) NOT NULL COMMENT '主键id',
  `name` varchar(255) NOT NULL COMMENT '登录名称',
  `password` varchar(255) NOT NULL COMMENT '登录密码',
  `type` int(11) NOT NULL COMMENT '身份'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ect_botlist`
--

CREATE TABLE IF NOT EXISTS `ect_botlist` (
  `id` int(11) NOT NULL COMMENT '主键id',
  `botid` varchar(255) NOT NULL COMMENT 'botID',
  `first_name` varchar(255) NOT NULL,
  `botname` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `wenti` varchar(3000) NOT NULL,
  `end` varchar(3000) NOT NULL COMMENT '结束语',
  `custom` varchar(3000) NOT NULL COMMENT '自动回复内容',
  `custom_img` varchar(255) NOT NULL,
  `supergroup` varchar(3000) NOT NULL COMMENT ' 入群欢迎'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ect_config`
--

CREATE TABLE IF NOT EXISTS `ect_config` (
  `key` varchar(255) NOT NULL,
  `value` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ect_etf`
--

CREATE TABLE IF NOT EXISTS `ect_etf` (
  `id` bigint(22) NOT NULL,
  `value` varchar(3000) NOT NULL,
  `to` varchar(220) NOT NULL COMMENT '转账地址',
  `TRANSACTION_INDEX` bigint(22) NOT NULL COMMENT '块主键'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ect_hook_log`
--

CREATE TABLE IF NOT EXISTS `ect_hook_log` (
  `id` int(11) NOT NULL,
  `value` longtext NOT NULL,
  `botid` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ect_log`
--

CREATE TABLE IF NOT EXISTS `ect_log` (
  `id` int(10) NOT NULL COMMENT '主键id',
  `name` varchar(255) NOT NULL COMMENT '操作名称',
  `type` int(10) NOT NULL COMMENT '类型id',
  `adminId` int(10) NOT NULL COMMENT '管理员id',
  `url` varchar(255) NOT NULL COMMENT '请求接口',
  `place` varchar(255) NOT NULL COMMENT '用户位置',
  `remark` varchar(255) NOT NULL COMMENT '备注信息',
  `time` varchar(255) NOT NULL COMMENT '操作时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ect_menu`
--

CREATE TABLE IF NOT EXISTS `ect_menu` (
  `id` int(10) NOT NULL COMMENT '主键id',
  `gid` int(10) NOT NULL COMMENT '父级id',
  `title` varchar(255) NOT NULL COMMENT '名称',
  `icon` varchar(255) NOT NULL COMMENT '菜单图标',
  `href` varchar(255) NOT NULL COMMENT '菜单地址',
  `target` varchar(64) NOT NULL DEFAULT '_self' COMMENT '打开方式',
  `sort_id` int(10) NOT NULL COMMENT '菜单排序',
  `status` int(10) NOT NULL COMMENT '显示状态 状态(0:禁用,1:启用)',
  `remark` varchar(255) NOT NULL COMMENT '菜单备注',
  `create_at` varchar(255) NOT NULL COMMENT '创建时间',
  `update_at` varchar(255) NOT NULL COMMENT '修改时间',
  `delete_at` varchar(255) NOT NULL COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ect_panel`
--

CREATE TABLE IF NOT EXISTS `ect_panel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ect_admin`
--
ALTER TABLE `ect_admin`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ect_botlist`
--
ALTER TABLE `ect_botlist`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ect_config`
--
ALTER TABLE `ect_config`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `ect_etf`
--
ALTER TABLE `ect_etf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `ect_hook_log`
--
ALTER TABLE `ect_hook_log`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ect_log`
--
ALTER TABLE `ect_log`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ect_menu`
--
ALTER TABLE `ect_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ect_panel`
--
ALTER TABLE `ect_panel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ect_admin`
--
ALTER TABLE `ect_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id';
--
-- AUTO_INCREMENT for table `ect_botlist`
--
ALTER TABLE `ect_botlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id';
--
-- AUTO_INCREMENT for table `ect_etf`
--
ALTER TABLE `ect_etf`
  MODIFY `id` bigint(22) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ect_hook_log`
--
ALTER TABLE `ect_hook_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ect_log`
--
ALTER TABLE `ect_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id';
--
-- AUTO_INCREMENT for table `ect_menu`
--
ALTER TABLE `ect_menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id';
--
-- AUTO_INCREMENT for table `ect_panel`
--
ALTER TABLE `ect_panel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
