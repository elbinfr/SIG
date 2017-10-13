/*
@license

dhtmlxGantt v.4.2.1 Professional Evaluation
This software is covered by DHTMLX Evaluation License. Contact sales@dhtmlx.com to get Commercial or Enterprise license. Usage without proper license is prohibited.

(c) Dinamenta, UAB.
*/
Gantt.plugin(function(t){t._formatLink=function(e){var n=[],i=this._get_link_target(e),a=this._get_link_source(e);if(!a||!i)return n;if(t.isChildOf(a.id,i.id)&&t._isProject(i)||t.isChildOf(i.id,a.id)&&t._isProject(a))return n;for(var r=this._getImplicitLinks(e,a,function(t){return 0}),s=t.config.auto_scheduling_move_projects,o=this._isProject(i)?this.getSubtaskDates(i.id):{start_date:i.start_date,end_date:i.end_date},c=this._getImplicitLinks(e,i,function(e){return s?e.$target.length||t.getState().drag_id==e.id?0:t.calculateDuration({
start_date:o.start_date,end_date:e.start_date,task:a}):0}),u=0;u<r.length;u++)for(var d=r[u],l=0;l<c.length;l++){var h=c[l],g=1*d.lag+1*h.lag,_={id:e.id,type:e.type,source:d.task,target:h.task,lag:(1*e.lag||0)+g};n.push(t._convertToFinishToStartLink(h.task,_,a,i))}return n},t._getImplicitLinks=function(t,e,n){var i=[];return this._isProject(e)?this.eachTask(function(t){this._isProject(t)||i.push({task:t.id,lag:n(t)})},e.id):i.push({task:e.id,lag:0}),i},t._getDirectDependencies=function(t,e){for(var n=[],i=[],a=e?t.$source:t.$target,r=0;r<a.length;r++){
var s=this.getLink(a[r]);this.isTaskExists(s.source)&&this.isTaskExists(s.target)&&n.push(this.getLink(a[r]))}for(var r=0;r<n.length;r++)i=i.concat(this._formatLink(n[r]));return i},t._getInheritedDependencies=function(t,e){var n=[],i=[];if(this.isTaskExists(t.id)){this._eachParent(function(t){this._isProject(t)&&i.push.apply(i,this._getDirectDependencies(t,e))},t.id,this);for(var a=0;a<i.length;a++){var r=e?i[a].source:i[a].target;r==t.id&&n.push(i[a])}}return n},t._getDirectSuccessors=function(t){
return this._getDirectDependencies(t,!0)},t._getInheritedSuccessors=function(t){return this._getInheritedDependencies(t,!0)},t._getDirectPredecessors=function(t){return this._getDirectDependencies(t,!1)},t._getInheritedPredecessors=function(t){return this._getInheritedDependencies(t,!1)},t._getSuccessors=function(t){return this._getDirectSuccessors(t).concat(this._getInheritedSuccessors(t))},t._getPredecessors=function(t){return this._getDirectPredecessors(t).concat(this._getInheritedPredecessors(t));
},t._convertToFinishToStartLink=function(e,n,i,a){var r={target:e,link:t.config.links.finish_to_start,id:n.id,lag:n.lag||0,source:n.source,preferredStart:null},s=0;switch(n.type){case t.config.links.start_to_start:s=-i.duration;break;case t.config.links.finish_to_finish:s=-a.duration;break;case t.config.links.start_to_finish:s=-i.duration-a.duration;break;default:s=0}return r.lag+=s,r},t.config.highlight_critical_path=!1,t._criticalPathHandler=function(){t.config.highlight_critical_path&&t.render();
},t.attachEvent("onAfterLinkAdd",t._criticalPathHandler),t.attachEvent("onAfterLinkUpdate",t._criticalPathHandler),t.attachEvent("onAfterLinkDelete",t._criticalPathHandler),t.attachEvent("onAfterTaskAdd",t._criticalPathHandler),t.attachEvent("onAfterTaskUpdate",t._criticalPathHandler),t.attachEvent("onAfterTaskDelete",t._criticalPathHandler),t._isCriticalTask=function(t,e){if(t&&t.id){var n=e||{};if(this._isProjectEnd(t))return!0;n[t.id]=!0;for(var i=this._getDependencies(t),a=0;a<i.length;a++){var r=this.getTask(i[a].target);
if(this._getSlack(t,r,i[a])<=0&&!n[r.id]&&this._isCriticalTask(r,n))return!0}return!1}},t.isCriticalTask=function(e){return t.assert(!(!e||void 0===e.id),"Invalid argument for gantt.isCriticalTask"),this._isCriticalTask(e,{})},t.isCriticalLink=function(e){return this.isCriticalTask(t.getTask(e.source))},t.getSlack=function(t,e){for(var n=[],i={},a=0;a<t.$source.length;a++)i[t.$source[a]]=!0;for(var a=0;a<e.$target.length;a++)i[e.$target[a]]&&n.push(e.$target[a]);for(var r=[],a=0;a<n.length;a++){var s=this.getLink(n[a]);
r.push(this._getSlack(t,e,this._convertToFinishToStartLink(s.id,s,t,e)))}return Math.min.apply(Math,r)},t._getSlack=function(t,e,n){var i=this.config.types,a=null;a=this._get_safe_type(t.type)==i.milestone?t.start_date:t.end_date;var r=e.start_date,s=0;s=+a>+r?-this.calculateDuration({start_date:r,end_date:a,task:t}):this.calculateDuration({start_date:a,end_date:r,task:t});var o=n.lag;return o&&1*o==o&&(s-=o),s},t._getProjectEnd=function(){var e=t.getTaskByTime();return e=e.sort(function(t,e){return+t.end_date>+e.end_date?1:-1;
}),e.length?e[e.length-1].end_date:null},t._isProjectEnd=function(t){return!this._hasDuration({start_date:t.end_date,end_date:this._getProjectEnd(),task:t})},t._getSummaryPredecessors=function(e){var n=[];return this._eachParent(function(e){this._isProject(e)&&(n=n.concat(t._getDependencies(e)))},e),n},t._getDependencies=function(t){var e=this._getSuccessors(t).concat(this._getSummaryPredecessors(t));return e}});
//# sourceMappingURL=../sources/ext/dhtmlxgantt_critical_path.js.map